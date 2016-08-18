<?php
namespace AliExpressSDKTest;

use AliExpressSDK\AliExpress;
use AliExpressSDK\AliExpressClient;
use AliExpressSDK\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class BaseTestCase
 * @package AliExpressSDKTest
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;
    /**
     * @var Response | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $message;

    public function setUp()
    {
        $this->client = $this->getMockBuilder(Client::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->message = $this->getMockBuilder(Response::class)
            ->setMethods(['getBody'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param array $response
     */
    protected function setClientResponse(array $response)
    {
        $this->message->expects($this->any())
            ->method('getBody')
            ->willReturn(json_encode($response));

        $this->client
            ->expects($this->any())
            ->method('request')
            ->willReturn($this->message);
    }

    /**
     * @param Config $config
     * @return AliExpress
     */
    protected function getAliExpressService(Config $config)
    {
        return new AliExpress(new AliExpressClient($config, $this->client));
    }
}