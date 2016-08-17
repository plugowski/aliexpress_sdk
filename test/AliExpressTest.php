<?php
namespace AliExpressSDKTest;

use AliExpressSDK\AliExpress;
use AliExpressSDK\AliExpressClient;
use AliExpressSDK\AliExpressFactory;
use AliExpressSDK\Config;
use AliExpressSDK\PromotionLink\PromotionLink;
use AliExpressSDK\PromotionLink\PromotionLinkCollection;
use AliExpressSDK\PromotionProduct\PromotionProduct;
use AliExpressSDK\PromotionProduct\PromotionProductCollection;
use AliExpressSDK\Request;

/**
 * Class AliExpressTest
 * @package AliExpressSDKTest
 */
class AliExpressTest extends \PHPUnit_Framework_TestCase
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
        self::assertEquals($url, $promotionLinks->getIterator()->current()->getUrl());
        self::assertEquals($promotionUrl, $promotionLinks->getIterator()->current()->getPromotionUrl());
        self::assertEquals($promotionUrl, $AliExpressSDK->getPromotionLink($trackingId, $url));
    }

    /**
     * @test
     */
    public function shouldGetPromotionProductAndBuildCollection()
    {
        $keywords = 'some keywords';

        $lotNum = 1;
        $packageType = 'piece';
        $imageUrl = '//is.alicdn.com/wsphoto/v0/1360130582/Smd-diode-ss12-font-b-mp3-b-font-.jpg';
        $productId = 1360130582;

        $discount = '0%';
        $validTime = '2014-05-21';
        $commissionRate = '5.0%';
        $monthCommission = 'US $0.00';
        $originalPrice = 'US $0.03';
        $productTitle = 'Smd diode ss12 mp3';
        $productUrl = 'https://www.aliexpress.com/item//1360130582.html';
        $salePrice = 'US $0.03';
        $commission = 'US $0.00';
        $evaluationScore = '';
        $volume = '0';
        $localPrice = 'GBP 0.01';

        $response = json_encode(['totalResults' => 105396,
            'products' => [
                0 => [
                    Request::FIELD_LOT_NUM => $lotNum,
                    Request::FIELD_PACKAGE_TYPE => $packageType,
                    Request::FIELD_IMAGE_URL => $imageUrl,
                    Request::FIELD_EVALUATE_SCORE => $evaluationScore,
                    Request::FIELD_VOLUME => $volume,
                    Request::FIELD_PRODUCT_ID => $productId,
                    Request::FIELD_DISCOUNT => $discount,
                    Request::FIELD_VALID_TIME => $validTime,
                    Request::FIELD_COMMISSION_RATE => $commissionRate,
                    Request::FIELD_30_DAYS_COMMISSION => $monthCommission,
                    Request::FIELD_ORIGINAL_PRICE => $originalPrice,
                    Request::FIELD_PRODUCT_TITLE => $productTitle,
                    Request::FIELD_PRODUCT_URL => $productUrl,
                    Request::FIELD_SALE_PRICE => $salePrice,
                    Request::FIELD_COMMISSION => $commission,
                    Request::FIELD_LOCAL_PRICE => $localPrice,
                ],
            ],
        ]);

        $this->AliExpressClient->expects($this->any())
            ->method('receive')
            ->willReturn(json_decode($response));

        $AliExpressSDK = new AliExpress($this->AliExpressClient);
        $promotionProductCollection = $AliExpressSDK->listPromotionProduct($keywords, [
            Request::PARAM_LANGUAGE => 'pl',
            Request::PARAM_VOLUME_TO => 1.23
        ]);

        self::assertEquals(1, count($promotionProductCollection));

        /** @var PromotionProduct $promotionProduct */
        $promotionProduct = $promotionProductCollection->getIterator()->current();
        self::assertEquals($productId, $promotionProduct->getProductId());
        self::assertEquals($productTitle, $promotionProduct->getProductTitle());
        self::assertEquals($productUrl, $promotionProduct->getProductUrl());
        self::assertEquals($lotNum, $promotionProduct->getLotNum());
        self::assertEquals($packageType, $promotionProduct->getPackageType());
        self::assertEquals($imageUrl, $promotionProduct->getImageUrl());
        self::assertEquals($volume, $promotionProduct->getVolume());
        self::assertEquals($validTime, $promotionProduct->getValidTime());

        self::assertEquals($discount, $promotionProduct->getPrice()->getDiscount());
        self::assertEquals($evaluationScore, $promotionProduct->getPrice()->getEvaluateScore());
        self::assertEquals($commission, $promotionProduct->getPrice()->getCommission());
        self::assertEquals($commissionRate, $promotionProduct->getPrice()->getCommissionRate());
        self::assertEquals($monthCommission, $promotionProduct->getPrice()->getMonthCommission());
        self::assertEquals($originalPrice, $promotionProduct->getPrice()->getOriginalPrice());
        self::assertEquals($salePrice, $promotionProduct->getPrice()->getSalePrice());
        self::assertEquals($localPrice, $promotionProduct->getPrice()->getLocalPrice());
    }

    /**
     * @test
     */
    public function shouldGetPromotionProductCollectionByCategoryId()
    {
        $lotNum = 1;
        $packageType = 'piece';
        $imageUrl = '//is.alicdn.com/wsphoto/v0/1360130582/Smd-diode-ss12-font-b-mp3-b-font-.jpg';
        $productId = 1360130582;

        $discount = '0%';
        $validTime = '2014-05-21';
        $commissionRate = '5.0%';
        $monthCommission = 'US $0.00';
        $originalPrice = 'US $0.03';
        $productTitle = 'Smd diode ss12 mp3';
        $productUrl = 'https://www.aliexpress.com/item//1360130582.html';
        $salePrice = 'US $0.03';
        $commission = 'US $0.00';
        $evaluationScore = '';
        $volume = '0';
        $localPrice = 'GBP 0.01';

        $response = json_encode(['totalResults' => 105396,
            'products' => [
                0 => [
                    Request::FIELD_LOT_NUM => $lotNum,
                    Request::FIELD_PACKAGE_TYPE => $packageType,
                    Request::FIELD_IMAGE_URL => $imageUrl,
                    Request::FIELD_EVALUATE_SCORE => $evaluationScore,
                    Request::FIELD_VOLUME => $volume,
                    Request::FIELD_PRODUCT_ID => $productId,
                    Request::FIELD_DISCOUNT => $discount,
                    Request::FIELD_VALID_TIME => $validTime,
                    Request::FIELD_COMMISSION_RATE => $commissionRate,
                    Request::FIELD_30_DAYS_COMMISSION => $monthCommission,
                    Request::FIELD_ORIGINAL_PRICE => $originalPrice,
                    Request::FIELD_PRODUCT_TITLE => $productTitle,
                    Request::FIELD_PRODUCT_URL => $productUrl,
                    Request::FIELD_SALE_PRICE => $salePrice,
                    Request::FIELD_COMMISSION => $commission,
                    Request::FIELD_LOCAL_PRICE => $localPrice,
                ],
            ],
        ]);

        $this->AliExpressClient->expects($this->any())
            ->method('receive')
            ->willReturn(json_decode($response));

        $AliExpressSDK = new AliExpress($this->AliExpressClient);
        self::assertInstanceOf(PromotionProductCollection::class, $AliExpressSDK->listPromotionProduct(123));
    }
}