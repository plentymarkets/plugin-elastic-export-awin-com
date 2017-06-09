<?php

namespace ElasticExportAwinCOM\Generator;

use ElasticExport\Helper\ElasticExportCoreHelper;
use ElasticExport\Helper\ElasticExportPriceHelper;
use ElasticExport\Helper\ElasticExportStockHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Plugin\Log\Loggable;

/**
 * Class AwinCOM
 * @package ElasticExportAwinCOM\Generator
 */
class AwinCOM extends CSVPluginGenerator
{
    use Loggable;

    const DELIMITER = ";";

    /**
     * @var ElasticExportCoreHelper
     */
    private $elasticExportHelper;

    /**
     * @var ElasticExportStockHelper
     */
    private $elasticExportStockHelper;

    /**
     * @var ElasticExportPriceHelper
     */
    private $elasticExportPriceHelper;

    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * @var array
     */
    private $shippingCostCache;

    /**
     * @var array
     */
    private $manufacturerCache;

    /**
     * AwinCOM constructor.
     *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Generates and populates the data into the CSV file.
     *
     * @param VariationElasticSearchScrollRepositoryContract $elasticSearch
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($elasticSearch, array $formatSettings = [], array $filter = [])
    {
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);

        $this->elasticExportStockHelper = pluginApp(ElasticExportStockHelper::class);

        $this->elasticExportPriceHelper = pluginApp(ElasticExportPriceHelper::class);

        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $this->setDelimiter(self::DELIMITER);

        $this->addCSVContent($this->head());

        $startTime = microtime(true);

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract)
        {
            // Initiate the counter for the variations limit
            $limitReached = false;
            $limit = 0;

            do
            {
                $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.writtenLines', [
                    'Lines written' => $limit,
                ]);

                // Stop writing if limit is reached
                if($limitReached === true)
                {
                    break;
                }

                $esStartTime = microtime(true);

                // Get the data from Elastic Search
                $resultList = $elasticSearch->execute();

                $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.esDuration', [
                    'Elastic Search duration' => microtime(true) - $esStartTime,
                ]);

                if(count($resultList['error']) > 0)
                {
                    $this->getLogger(__METHOD__)->error('ElasticExportAwinCOM::log.occurredElasticSearchErrors', [
                        'Error message' => $resultList['error'],
                    ]);
                }

                $buildRowsStartTime = microtime(true);

                if(is_array($resultList['documents']) && count($resultList['documents']) > 0)
                {
                    $previousItemId = null;

                    foreach ($resultList['documents'] as $variation)
                    {
                        // Stop and set the flag if limit is reached
                        if($limit == $filter['limit'])
                        {
                            $limitReached = true;
                            break;
                        }

                        // If filtered by stock is set and stock is negative, then skip the variation
                        if($this->elasticExportStockHelper->isFilteredByStock($variation, $filter) === true)
                        {
                            $this->getLogger(__METHOD__)->info('ElasticExportAwinCOM::log.variationNotPartOfExportStock', [
                                'VariationId' => (string)$variation['id']
                            ]);

                            continue;
                        }

                        try
                        {
                            // Set the caches if we have the first variation or when we have the first variation of an item
                            if($previousItemId === null || $previousItemId != $variation['data']['item']['id'])
                            {
                                $previousItemId = $variation['data']['item']['id'];
                                unset($this->shippingCostCache);

                                // Build the caches arrays
                                $this->buildCaches($variation, $settings);
                            }

                            // Build the new row for printing in the CSV file
                            $this->buildRow($variation, $settings);
                        }
                        catch(\Throwable $throwable)
                        {
                            $this->getLogger(__METHOD__)->error('ElasticExportAwinCOM::logs.fillRowError', [
                                'Error message ' => $throwable->getMessage(),
                                'Error line'     => $throwable->getLine(),
                                'VariationId'    => (string)$variation['id']
                            ]);
                        }

                        // New line was added
                        $limit++;
                    }

                    $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.buildRowsDuration', [
                        'Build rows duration' => microtime(true) - $buildRowsStartTime,
                    ]);
                }

            } while ($elasticSearch->hasNext());
        }

        $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.fileGenerationDuration', [
            'Whole file generation duration' => microtime(true) - $startTime,
        ]);
    }

    /**
     * Creates the header of the CSV file.
     *
     * @return array
     */
    private function head():array
    {
        return array(
            'prod_number',
            'prod_name',
            'prod_price',
            'currency_symbol',
            'category',
            'prod_description',
            'prod_description_long',
            'img_small',
            'img_medium',
            'img_large',
            'manufacturer',
            'prod_url',
            'prod_ean',
            'shipping_costs',
            'base_price',
            'base_price_amount',
            'base_price_unit',
        );
    }

    /**
     * Creates the variation row and prints it into the CSV file.
     *
     * @param array $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, KeyValue $settings)
    {
        $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.variationConstructRow', [
            'Data row duration' => 'Row printing start'
        ]);

        $rowTime = microtime(true);

        // Get the price list
        $priceList = $this->elasticExportPriceHelper->getPriceList($variation, $settings);

        // Only variations with the Retail Price greater than zero will be handled
        if(!is_null($priceList['price']) && $priceList['price'] > 0)
        {
            // Get shipping cost
            $shippingCost = $this->getShippingCost($variation);

            // Get the manufacturer
            $manufacturer = $this->getManufacturer($variation);

            // Get base price
            $price['variationRetailPrice.price'] = $priceList['price'];
            $basePrice = $this->elasticExportHelper->getBasePrice($variation, $price, $settings->get('lang'), '/', false, true, '', 0.0, false);

            // Get base price information list
            $basePriceList = $this->elasticExportHelper->getBasePriceList($variation, (float)$priceList['price'], $settings->get('lang'));

            $data = [
                'prod_number'           => $variation['id'],
                'prod_name'             => strip_tags(html_entity_decode($this->elasticExportHelper->getMutatedName($variation, $settings))),
                'prod_price'            => $priceList['price'],
                'currency_symbol'       => $priceList['currency'],
                'category'              => $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                'prod_description'      => strip_tags(html_entity_decode($this->elasticExportHelper->getMutatedPreviewText($variation, $settings, 256))),
                'prod_description_long' => strip_tags(html_entity_decode($this->elasticExportHelper->getMutatedDescription($variation, $settings, 256))),
                'img_small'             => $this->elasticExportHelper->getMainImage($variation, $settings, 'preview'),
                'img_medium'            => $this->elasticExportHelper->getMainImage($variation, $settings, 'middle'),
                'img_large'             => $this->elasticExportHelper->getMainImage($variation, $settings, 'normal'),
                'manufacturer'          => $manufacturer,
                'prod_url'              => $this->elasticExportHelper->getMutatedUrl($variation, $settings, true, false),
                'prod_ean'              => $this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode')),
                'shipping_costs'        => $shippingCost,
                'base_price'            => $basePrice,
                'base_price_amount'     => $basePriceList['lot'],
                'base_price_unit'       => $basePriceList['unit'],
            ];

            $this->addCSVContent(array_values($data));

            $this->getLogger(__METHOD__)->debug('ElasticExportAwinCOM::log.variationConstructRowFinished', [
                'Data row duration' => 'Row printing took: ' . (microtime(true) - $rowTime),
            ]);
        }
        else
        {
            $this->getLogger(__METHOD__)->info('ElasticExportAwinCOM::log.variationNotPartOfExportPrice', [
                'VariationId' => (string)$variation['id']
            ]);
        }
    }

    /**
     * Get the shipping cost.
     *
     * @param $variation
     * @return string
     */
    private function getShippingCost($variation):string
    {
        $shippingCost = null;
        if(isset($this->shippingCostCache) && array_key_exists($variation['data']['item']['id'], $this->shippingCostCache))
        {
            $shippingCost = $this->shippingCostCache[$variation['data']['item']['id']];
        }

        if(!is_null($shippingCost) && $shippingCost != '0.00')
        {
            return $shippingCost;
        }

        return '';
    }

    /**
     * Get the manufacturer name.
     *
     * @param $variation
     * @return string
     */
    private function getManufacturer($variation):string
    {
        if(isset($this->manufacturerCache) && array_key_exists($variation['data']['item']['manufacturer']['id'], $this->manufacturerCache))
        {
            return $this->manufacturerCache[$variation['data']['item']['manufacturer']['id']];
        }

        return '';
    }

    /**
     * Build the cache arrays for the item variation.
     *
     * @param $variation
     * @param $settings
     */
    private function buildCaches($variation, $settings)
    {
        if(!is_null($variation) && !is_null($variation['data']['item']['id']))
        {
            $shippingCost = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings, 0);
            $this->shippingCostCache[$variation['data']['item']['id']] = number_format((float)$shippingCost, 2, '.', '');

            if(!is_null($variation['data']['item']['manufacturer']['id']))
            {
                if(!isset($this->manufacturerCache) || (isset($this->manufacturerCache) && !array_key_exists($variation['data']['item']['manufacturer']['id'], $this->manufacturerCache)))
                {
                    $manufacturer = $this->elasticExportHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id']);
                    $this->manufacturerCache[$variation['data']['item']['manufacturer']['id']] = $manufacturer;
                }
            }
        }
    }
}
