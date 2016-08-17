<?php
namespace AliExpressSDKTest;

use AliExpressSDK\PromotionLink\PromotionLinksRequest;
use AliExpressSDK\PromotionProduct\PromotionProductRequest;
use AliExpressSDK\RequestInvalidFieldException;
use AliExpressSDK\RequestTooManyArgumentsException;

/**
 * Class RequestTest
 * @package AliExpressSDKTest
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldCreatePromotionLinkRequest()
    {
        $trackingId = 'exrs';
        $urls = ['http://example.com/1234567890', 'http://example.com/987654321'];
        $fields = [PromotionLinksRequest::FIELD_URL, PromotionLinksRequest::FIELD_PROMOTION_URL];

        $params = [
            PromotionLinksRequest::PARAM_FIELDS => implode(',', $fields),
            PromotionLinksRequest::PARAM_URLS => implode(',', $urls),
            PromotionLinksRequest::PARAM_TRACKING_ID => $trackingId
        ];

        $promotionLinks = new PromotionLinksRequest();
        $promotionLinks->setTrackingId($trackingId)->setUrls($urls)->setFields($fields);

        self::assertEquals('getPromotionLinks', $promotionLinks->getName());
        self::assertEquals('Call succeeds', $promotionLinks->getErrorMessage(20010000));
        self::assertEquals('Unknown error', $promotionLinks->getErrorMessage(1));
        self::assertEquals($params, $promotionLinks->getParams());
    }

    /**
     * @test
     */
    public function shouldThrowTooManyArgumentsException()
    {
        $this->setExpectedException(RequestTooManyArgumentsException::class);
        $urls = array_fill(0, 51, 'http://test.com');
        (new PromotionLinksRequest())->setUrls($urls);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidFieldException()
    {
        $this->setExpectedException(RequestInvalidFieldException::class);
        (new PromotionLinksRequest())->setFields(['not_exists', 'other_not_exists', PromotionLinksRequest::FIELD_TOTAL_RESULTS]);
    }

    /**
     * @test
     */
    public function shouldCreatePromotionProductRequest()
    {
        $fields = [PromotionProductRequest::FIELD_TOTAL_RESULTS, PromotionProductRequest::FIELD_PRODUCT_TITLE];
        $keywords = 'some test';

        $params = [
            PromotionProductRequest::PARAM_FIELDS => implode(',', $fields),
            PromotionProductRequest::PARAM_KEYWORDS => $keywords,
        ];

        $promotionProduct = new PromotionProductRequest();
        $promotionProduct
            ->setFields($fields)
            ->setKeywords($keywords);

        self::assertEquals($params, $promotionProduct->getParams());

        $promotionProduct = (new PromotionProductRequest())->setParams([
            'NotExists' => 'SomeValue',
            PromotionProductRequest::PARAM_FIELDS => implode(',', $fields),
            PromotionProductRequest::PARAM_KEYWORDS => $keywords
        ]);

        self::assertEquals($params, $promotionProduct->getParams());
    }
}