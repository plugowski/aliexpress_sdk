<?php
namespace AliExpressSDK;

use GuzzleHttp\Client;

/**
 * Class AliExpressFactory
 * @package AliExpressSDK
 */
class AliExpressFactory
{
    /**
     * @param Config $config
     * @return AliExpress
     */
    public static function create(Config $config)
    {
        return new AliExpress(new AliExpressClient($config, new Client()));
    }
}