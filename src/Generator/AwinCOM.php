<?php
namespace ElasticExportAwinCOM\Generator;

use ElasticExport\Helper\ElasticExportCoreHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\DataLayer\Models\Record;
use Plenty\Modules\Item\DataLayer\Models\RecordList;


/**
 * Class AwinCOM
 * @package ElasticExportAwinCOM\Generator
 */
class AwinCOM extends CSVPluginGenerator
{
    /**
     * @var ElasticExportCoreHelper
     */
    private $elasticExportCoreHelper;

    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * @var array
     */
    private $idlVariations = array();


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
     * @param array $resultData
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($resultData, array $formatSettings = [], array $filter = [])
    {
        $this->elasticExportCoreHelper = pluginApp(ElasticExportCoreHelper::class);

        if(is_array($resultData) && count($resultData['documents']) > 0)
        {
            $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

            $this->setDelimiter(";");

            $this->addCSVContent([
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
            ]);

            // Create a List with all VariationIds
            $variationIdList = array();
            foreach($resultData['documents'] as $variation)
            {
                $variationIdList[] = $variation['id'];
            }

            // Get the missing ES fields from IDL(ItemDataLayer)
            if(is_array($variationIdList) && count($variationIdList) > 0)
            {
                /**
                 * @var \ElasticExportAwinCOM\IDL_ResultList\AwinCOM $idlResultList
                 */
                $idlResultList = pluginApp(\ElasticExportAwinCOM\IDL_ResultList\AwinCOM::class);
                $idlResultList = $idlResultList->getResultList($variationIdList, $settings, $filter);
            }

            // Creates an array with the variationId as key to surpass the sorting problem
            if(isset($idlResultList) && $idlResultList instanceof RecordList)
            {
                $this->createIdlArray($idlResultList);
            }

            foreach($resultData['documents'] as $variation)
            {
                // Get price and base price information list
                $price = $this->idlVariations[$variation['id']]['variationRetailPrice.price'];
                $basePriceList = $this->elasticExportCoreHelper->getBasePriceList($variation, $price, $settings->get('lang'));

                // Get shipping costs
                $shippingCost = $this->elasticExportCoreHelper->getShippingCost($variation['data']['item']['id'], $settings);
                if(!is_null($shippingCost))
                {
                    $shippingCost = number_format((float)$shippingCost, 2, '.', '');
                }
                else
                {
                    $shippingCost = '';
                }

                $data = [
                    'prod_number'           => $variation['id'],
                    'prod_name'             => strip_tags(html_entity_decode($this->elasticExportCoreHelper->getName($variation, $settings))),
                    'prod_price'            => number_format((float)$price, 2, '.', ''),
                    'currency_symbol'       => $this->idlVariations[$variation['id']]['variationRetailPrice.currency'],
                    'category'              => $this->elasticExportCoreHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                    'prod_description'      => strip_tags(html_entity_decode($this->elasticExportCoreHelper->getPreviewText($variation, $settings, 256))),
                    'prod_description_long' => strip_tags(html_entity_decode($this->elasticExportCoreHelper->getDescription($variation, $settings, 256))),
                    'img_small'             => $this->elasticExportCoreHelper->getMainImage($variation, $settings, 'preview'),
                    'img_medium'            => $this->elasticExportCoreHelper->getMainImage($variation, $settings, 'middle'),
                    'img_large'             => $this->elasticExportCoreHelper->getMainImage($variation, $settings, 'normal'),
                    'manufacturer'          => $this->elasticExportCoreHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id']),
                    'prod_url'              => $this->elasticExportCoreHelper->getUrl($variation, $settings, true, false),
                    'prod_ean'              => $this->elasticExportCoreHelper->getBarcodeByType($variation, $settings->get('barcode')),
                    'shipping_costs'        => $shippingCost,
                    'base_price'            => $this->elasticExportCoreHelper->getBasePrice($variation, $this->idlVariations[$variation['id']], $settings->get('lang'), '/', false, true, '', 0.0, false),
                    'base_price_amount'     => $basePriceList['lot'],
                    'base_price_unit'       => $basePriceList['unit']
                ];

                $this->addCSVContent(array_values($data));
            }
        }
    }

    /**
     * Creates an array with the rest of data needed from the ItemDataLayer.
     *
     * @param RecordList $idlResultList
     */
    private function createIdlArray($idlResultList)
    {
        if($idlResultList instanceof RecordList)
        {
            foreach($idlResultList as $idlVariation)
            {
                if($idlVariation instanceof Record)
                {
                    $this->idlVariations[$idlVariation->variationBase->id] = [
                        'itemBase.id' => $idlVariation->itemBase->id,
                        'variationBase.id' => $idlVariation->variationBase->id,
                        'variationRetailPrice.price' => $idlVariation->variationRetailPrice->price,
                        'variationRetailPrice.currency' => $idlVariation->variationRetailPrice->currency
                    ];
                }
            }
        }
    }
}
