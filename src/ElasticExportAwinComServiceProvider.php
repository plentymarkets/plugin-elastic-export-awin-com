<?php

namespace ElasticExportAwinCOM;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;


/**
 * Class ElasticExportAwinComServiceProvider
 * @package ElasticExportAwinCom
 */
class ElasticExportAwinComServiceProvider extends DataExchangeServiceProvider
{
    /**
     * Abstract function for registering the service provider.
     */
    public function register()
    {

    }

    /**
     * Adds the export format to the export container.
     *
     * @param ExportPresetContainer $container
     */
    public function exports(ExportPresetContainer $container)
    {
        $container->add(
            'AwinCOM-Plugin',
            'ElasticExportAwinCom\ResultField\AwinCOM',
            'ElasticExportAwinCom\Generator\AwinCOM',
            '',
            true
        );
    }
}