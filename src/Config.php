<?php
namespace AliExpressSDK;

/**
 * Class Config
 * @package AliExpressSDK
 */
class Config
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $signature;

    /**
     * Config constructor.
     * @param string $apiKey
     * @param string $signature
     */
    public function __construct($apiKey, $signature)
    {
        $this->apiKey = $apiKey;
        $this->signature = $signature;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}