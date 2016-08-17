<?php
namespace AliExpressSDKTest;

use AliExpressSDK\PromotionLink\PromotionLinksRequest;
use AliExpressSDK\PromotionProduct\PromotionProductRequest;
use AliExpressSDK\Request;
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
        $fields = [Request::FIELD_URL, Request::FIELD_PROMOTION_URL];

        $params = [
            Request::PARAM_FIELDS => implode(',', $fields),
            Request::PARAM_URLS => implode(',', $urls),
            Request::PARAM_TRACKING_ID => $trackingId
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
    public function shouldThrowInvalidFieldExceptionForProducts()
    {
        $this->setExpectedException(RequestInvalidFieldException::class);
        (new PromotionProductRequest())->setFields(['not_exists', 'other_not_exists', PromotionLinksRequest::FIELD_TOTAL_RESULTS]);
    }

    /**
     * @test
     */
    public function shouldCreatePromotionProductRequest()
    {
        $fields = [Request::FIELD_TOTAL_RESULTS, Request::FIELD_PRODUCT_TITLE];
        $keywords = 'some test';
        $categoryId = 123;
        $priceFrom = 1;
        $priceTo = 5;
        $volumeFrom = 1;
        $volumeTo = 20;
        $pageNo = 1;
        $pageSize = 40;
        $sort = 'commissionRateDown';
        $startScore = 1;
        $endScore = 15;
        $qItems = 'true';
        $currency = 'USD';
        $language = 'pl';

        $params = [
            Request::PARAM_FIELDS => implode(',', $fields),
            Request::PARAM_KEYWORDS => $keywords,
            Request::PARAM_CATEGORY_ID => $categoryId,
            Request::PARAM_ORIGINAL_PRICE_FROM => $priceFrom,
            Request::PARAM_ORIGINAL_PRICE_TO => $priceTo,
            Request::PARAM_VOLUME_FROM => $volumeFrom,
            Request::PARAM_VOLUME_TO => $volumeTo,
            Request::PARAM_PAGE_NO => $pageNo,
            Request::PARAM_PAGE_SIZE => $pageSize,
            Request::PARAM_SORT => $sort,
            Request::PARAM_START_CREDIT_SCORE => $startScore,
            Request::PARAM_END_CREDIT_SCORE => $endScore,
            Request::PARAM_HIGH_QUALITY_ITEMS => $qItems,
            Request::PARAM_LOCAL_CURRENCY => $currency,
            Request::PARAM_LANGUAGE => $language
        ];

        $promotionProduct = new PromotionProductRequest();
        $promotionProduct
            ->setFields($fields)
            ->setKeywords($keywords)
            ->setCategoryId($categoryId)
            ->setOriginalPriceFrom($priceFrom)
            ->setOriginalPriceTo($priceTo)
            ->setVolumeFrom($volumeFrom)
            ->setVolumeTo($volumeTo)
            ->setPageNo($pageNo)
            ->setPageSize($pageSize)
            ->setSort($sort)
            ->setStartCreditScore($startScore)
            ->setEndCreditScore($endScore)
            ->setHighQualityItems($qItems)
            ->setLocalCurrency($currency)
            ->setLanguage($language);

        self::assertEquals($params, $promotionProduct->getParams());

        $promotionProduct = (new PromotionProductRequest())->setParams([
            'NotExists' => 'SomeValue',
            Request::PARAM_FIELDS => implode(',', $fields),
            Request::PARAM_KEYWORDS => $keywords
        ]);

        $params = [
            Request::PARAM_FIELDS => implode(',', $fields),
            Request::PARAM_KEYWORDS => $keywords
        ];

        self::assertEquals($params, $promotionProduct->getParams());
    }
}