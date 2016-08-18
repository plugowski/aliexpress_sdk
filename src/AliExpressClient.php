<?php
namespace AliExpressSDK;

use GuzzleHttp\Client;

/**
 * Class AliExpressClient
 * @package AliExpressSDK
 */
class AliExpressClient
{
    const CODE_SUCCESS = 20010000;

    /**
     * @var string
     */
    private $apiUrl = 'http://gw.api.alibaba.com/openapi/param2/2/portals.open/api.';
    /**
     * @var Config
     */
    private $config;

    /**
     * AliExpressClient constructor.
     * @param Config $config
     * @param Client $client
     */
    public function __construct(Config $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return \stdClass
     * @throws AliExpressClientException
     */
    public function receive(Request $request)
    {
        $uri = $this->apiUrl . $request->getName() . '/' . $this->config->getApiKey();
        $response = json_decode($this->client->request('GET', $uri, ['query' => $request->getParams()])->getBody());

        if (self::CODE_SUCCESS !== $response->errorCode) {
            throw new AliExpressClientException($request->getErrorMessage($response->errorCode), $response->errorCode);
        }

        return $response->result;
    }
}