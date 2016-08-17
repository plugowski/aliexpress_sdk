<?php
namespace AliExpressSDK\PromotionProduct;

use AliExpressSDK\Request;
use AliExpressSDK\RequestInvalidFieldException;

/**
 * Class PromotionProductRequest
 * @package AliExpressSDK\PromotionProduct
 */
class PromotionProductRequest extends Request
{
    /**
     * @var string
     */
    protected $name = 'listPromotionProduct';

    /**
     * @var array
     */
    protected $allowedFields = [
        self::FIELD_TOTAL_RESULTS,
        self::FIELD_PRODUCT_ID,
        self::FIELD_PRODUCT_TITLE,
        self::FIELD_PRODUCT_URL,
        self::FIELD_IMAGE_URL,
        self::FIELD_ORIGINAL_PRICE,
        self::FIELD_SALE_PRICE,
        self::FIELD_EVALUATE_SCORE,
        self::FIELD_COMMISSION,
        self::FIELD_COMMISSION_RATE,
        self::FIELD_30_DAYS_COMMISSION,
        self::FIELD_VOLUME,
        self::FIELD_PACKAGE_TYPE,
        self::FIELD_LOT_NUM,
        self::FIELD_VALID_TIME
    ];

    /**
     * @var array
     */
    protected $requestParams = [
        self::PARAM_FIELDS,
        self::PARAM_KEYWORDS,
        self::PARAM_CATEGORY_ID,
        self::PARAM_ORIGINAL_PRICE_FROM,
        self::PARAM_ORIGINAL_PRICE_TO,
        self::PARAM_VOLUME_FROM,
        self::PARAM_VOLUME_TO,
        self::PARAM_PAGE_NO,
        self::PARAM_PAGE_SIZE,
        self::PARAM_SORT,
        self::PARAM_VALUE,
        self::PARAM_START_CREDIT_SCORE,
        self::PARAM_END_CREDIT_SCORE,
        self::PARAM_HIGH_QUALITY_ITEMS,
        self::PARAM_LOCAL_CURRENCY,
        self::PARAM_LANGUAGE
    ];

    /**
     * @var array
     */
    protected $errors = [
        20010000 => 'Call succeeds',
        20020000 => 'System Error',
        20030000 => 'Unauthorized transfer request',
        20030010 => 'Required parameters',
        20030020 => 'Invalid protocol format',
        20030030 => 'API version input parameter error',
        20030040 => 'API name space input parameter error',
        20030050 => 'API name input parameter error',
        20030060 => 'Fields input parameter error',
        20030070 => 'Keyword input parameter error',
        20030080 => 'Category ID input parameter error',
        20030090 => 'Tracking ID input parameter error',
        20030100 => 'Commission rate input parameter error',
        20030110 => 'Original Price input parameter error',
        20030120 => 'Discount input parameter error',
        20030130 => 'Volume input parameter error',
        20030140 => 'Page number input parameter error',
        20030150 => 'Page size input parameter error',
        20030160 => 'Sort input parameter error',
        20030170 => 'Credit Score input parameter error'
    ];

    /**
     * @var string
     */
    protected $fields;
    /**
     * @var string
     */
    protected $keywords;
    /**
     * @var string
     */
    protected $categoryId;
    /**
     * @var float
     */
    protected $originalPriceFrom;
    /**
     * @var float
     */
    protected $originalPriceTo;
    /**
     * @var int
     */
    protected $volumeFrom;
    /**
     * @var int
     */
    protected $volumeTo;
    /**
     * @var int
     */
    protected $pageNo;
    /**
     * @var int
     */
    protected $pageSize;
    /**
     * @var string
     */
    protected $sort;
    /**
     * @var int
     */
    protected $startCreditScore;
    /**
     * @var int
     */
    protected $endCreditScore;
    /**
     * @var string
     */
    protected $highQualityItems;
    /**
     * @var string
     */
    protected $localCurrency;
    /**
     * @var string
     */
    protected $language;

    /**
     * @param array $fields
     * @return $this
     * @throws RequestInvalidFieldException
     */
    public function setFields(array $fields)
    {
        if (false === $this->validateFields($fields)) {
            throw new RequestInvalidFieldException(array_diff($fields, $this->allowedFields));
        }
        $this->fields = implode(',', $fields);
        return $this;
    }

    /**
     * @param string $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @param string $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @param float $originalPriceFrom
     * @return $this
     */
    public function setOriginalPriceFrom($originalPriceFrom)
    {
        $this->originalPriceFrom = $originalPriceFrom;
        return $this;
    }

    /**
     * @param float $originalPriceTo
     * @return $this
     */
    public function setOriginalPriceTo($originalPriceTo)
    {
        $this->originalPriceTo = $originalPriceTo;
        return $this;
    }

    /**
     * @param int $volumeFrom
     * @return $this
     */
    public function setVolumeFrom($volumeFrom)
    {
        $this->volumeFrom = $volumeFrom;
        return $this;
    }

    /**
     * @param int $volumeTo
     * @return $this
     */
    public function setVolumeTo($volumeTo)
    {
        $this->volumeTo = $volumeTo;
        return $this;
    }

    /**
     * @param int $pageNo
     * @return $this
     */
    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;
        return $this;
    }

    /**
     * @param int $pageSize
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @param string $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param int $startCreditScore
     * @return $this
     */
    public function setStartCreditScore($startCreditScore)
    {
        $this->startCreditScore = $startCreditScore;
        return $this;
    }

    /**
     * @param int $endCreditScore
     * @return $this
     */
    public function setEndCreditScore($endCreditScore)
    {
        $this->endCreditScore = $endCreditScore;
        return $this;
    }

    /**
     * @param string $highQualityItems
     * @return $this
     */
    public function setHighQualityItems($highQualityItems)
    {
        $this->highQualityItems = $highQualityItems;
        return $this;
    }

    /**
     * @param string $localCurrency
     * @return $this
     */
    public function setLocalCurrency($localCurrency)
    {
        $this->localCurrency = $localCurrency;
        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }
}