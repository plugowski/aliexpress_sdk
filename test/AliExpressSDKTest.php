<?php
namespace AliExpressSDKTest;

use AliExpressSDK\AliExpress;
use AliExpressSDK\AliExpressClient;
use AliExpressSDK\AliExpressFactory;
use AliExpressSDK\Config;
use AliExpressSDK\PromotionLink\PromotionLink;
use AliExpressSDK\PromotionLink\PromotionLinkCollection;

/**
 * Class RequestTest
 * @package AliExpressSDKTest
 */
class AliExpressSDKTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AliExpressClient | \PHPUnit_Framework_MockObject_MockObject
     */
    private $AliExpressClient;

    public function setUp()
    {
        parent::setUp();

        $this->AliExpressClient = $this->getMockBuilder(AliExpressClient::class)
            ->setMethods(['receive'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function shouldCreateApiObjectByFactory()
    {
        $AliExpressSDK = AliExpressFactory::create(new Config('380a3d072b16d73d808d773d7cac4698', '7820539-cec1bb-7562ee3b071f1-464b67'));
        self::assertInstanceOf(AliExpress::class, $AliExpressSDK);
    }

    /**
     * @test
     */
    public function shouldGetPromotionLinks()
    {
        $url = 'https://www.aliexpress.com/item//852517607.html';
        $promotionUrl = 'http://s.click.aliexpress.com/e/F3aeyMf';
        $trackingId = 'pann';

        $promotionLinkCollection = new PromotionLinkCollection();
        $promotionLinkCollection->add(new PromotionLink($url, $promotionUrl));

        $this->AliExpressClient->expects($this->any())
            ->method('receive')
            ->willReturn([
                'promotionUrls' => [
                    0 => [
                        0 => $url,
                        1 => $promotionUrl,
                    ],
                ],
                'publisherId' => 107470220,
                'trackingId' => $trackingId,
            ]);

        $AliExpressSDK = new AliExpress($this->AliExpressClient);
        $promotionLinks = $AliExpressSDK->getPromotionLinkCollection($trackingId, [$url]);

        self::assertEquals($promotionLinkCollection, $promotionLinks);
        self::assertEquals($promotionUrl, $AliExpressSDK->getPromotionLink($trackingId, $url));
    }

    /**
     * @test
     */
    public function shouldGetPromotionProduct()
    {
        $url = 'https://www.aliexpress.com/item//852517607.html';
        $promotionUrl = 'http://s.click.aliexpress.com/e/F3aeyMf';
        $keywords = 'some keywords';

        $promotionLinkCollection = new PromotionLinkCollection();
        $promotionLinkCollection->add(new PromotionLink($url, $promotionUrl));

        $this->AliExpressClient->expects($this->any())
            ->method('receive')
            ->willReturn(json_decode('{ "totalResults": 105396, "products": [ { "lotNum": 1, "packageType": "piece", "imageUrl": "//is.alicdn.com/wsphoto/v0/1360130582/Smd-diode-ss12-font-b-mp3-b-font-.jpg", "evaluationScore": "", "volume": "0", "productId": 1360130582, "discount": "0%", "validTime": "2014-05-21", "commissionRate": "5.0%", "30daysCommission": "US $0.00", "originalPrice": "US $0.03", "productTitle": "Smd diode ss12 mp3", "productUrl": "https://www.aliexpress.com/item//1360130582.html", "salePrice": "US $0.03", "commission": "US $0.00" } ] }'));

        $AliExpressSDK = new AliExpress($this->AliExpressClient);
        $promotionLinks = $AliExpressSDK->listPromotionProduct($keywords, []);

        self::assertEquals($promotionLinkCollection, $promotionLinks);
        self::assertEquals($promotionUrl, $AliExpressSDK->getPromotionLink($keywords, $url));
    }
}