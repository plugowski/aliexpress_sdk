<?php
namespace AliExpressSDKTest;

use AliExpressSDK\AliExpressClient;
use AliExpressSDK\AliExpressClientException;
use AliExpressSDK\Config;
use AliExpressSDK\PromotionLink\PromotionLinksRequest;

/**
 * Class AliExpressClientTest
 * @package AliExpressSDKTest
 */
class AliExpressClientTest extends BaseTestCase
{
    /**
     * @test
     */
    public function shouldCreateAliExpressClientInstance()
    {
        $url = 'http://example.com';
        $promotionUrl = 'http://click.example2.com?=linkexample.com?aff=1234';

        $this->setClientResponse([
            'result' => [
                'promotionUrls' => [
                    [
                        'url' => $url,
                        'promotionUrl' => $promotionUrl,
                    ],
                ],
                'publisherId' => 107470220,
                'trackingId' => 'pann',
            ],
            'errorCode' => 20010000
        ]);

        $request = (new PromotionLinksRequest())->setTrackingId('pann')->setUrls([$url]);

        $aliExpressClient = new AliExpressClient(new Config('AAAA', 'BBBB'), $this->client);
        $response = $aliExpressClient->receive($request);

        self::assertEquals($url, $response->promotionUrls[0]->url);
        self::assertEquals($promotionUrl, $response->promotionUrls[0]->promotionUrl);

    }

    /**
     * @test
     */
    public function shouldThrowAliExpressClientException()
    {
        $this->setExpectedException(AliExpressClientException::class);

        $this->setClientResponse([
            'result' => [],
            'errorCode' => 20020000
        ]);

        $request = (new PromotionLinksRequest())->setTrackingId('pann')->setUrls(['http://example.com']);
        $aliExpressClient = new AliExpressClient(new Config('AAAA', 'BBBB'), $this->client);
        $aliExpressClient->receive($request);

    }
}