<?php
namespace AliExpressSDK;

/**
 * Class Request
 * @package AliExpressSDK
 */
abstract class Request
{
    /**
     * Fields
     */
    const FIELD_30_DAYS_COMMISSION = '30daysCommission';
    const FIELD_COMMISSION = 'commission';
    const FIELD_COMMISSION_RATE = 'commissionRate';
    const FIELD_DISCOUNT = 'discount';
    const FIELD_EVALUATE_SCORE = 'evaluateScore';
    const FIELD_IMAGE_URL = 'imageUrl';
    const FIELD_LOCAL_PRICE = 'localPrice';
    const FIELD_LOT_NUM = 'lotNum';
    const FIELD_ORIGINAL_PRICE = 'originalPrice';
    const FIELD_PACKAGE_TYPE = 'packageType';
    const FIELD_PRODUCT_ID = 'productId';
    const FIELD_PRODUCT_TITLE = 'productTitle';
    const FIELD_PRODUCT_URL = 'productUrl';
    const FIELD_PROMOTION_URL = 'promotionUrl';
    const FIELD_PUBLISHER_ID = 'publisherId';
    const FIELD_SALE_PRICE = 'salePrice';
    const FIELD_TOTAL_RESULTS = 'totalResults';
    const FIELD_TRACKING_ID = 'trackingId';
    const FIELD_URL = 'url';
    const FIELD_VALID_TIME = 'validTime';
    const FIELD_VOLUME = 'volume';

    /**
     * Params
     */
    const PARAM_FIELDS = 'fields';
    const PARAM_TRACKING_ID = 'trackingId';
    const PARAM_URLS = 'urls';
    const PARAM_KEYWORDS = 'keywords';
    const PARAM_CATEGORY_ID = 'categoryId';
    const PARAM_ORIGINAL_PRICE_FROM = 'originalPriceFrom';
    const PARAM_ORIGINAL_PRICE_TO = 'originalPriceTo';
    const PARAM_VOLUME_FROM = 'volumeFrom';
    const PARAM_VOLUME_TO = 'volumeTo';
    const PARAM_PAGE_NO = 'pageNo';
    const PARAM_PAGE_SIZE = 'pageSize';
    const PARAM_SORT = 'sort';
    const PARAM_START_CREDIT_SCORE = 'startCreditScore';
    const PARAM_END_CREDIT_SCORE = 'endCreditScore';
    const PARAM_HIGH_QUALITY_ITEMS = 'highQualityItems';
    const PARAM_LOCAL_CURRENCY = 'localCurrency';
    const PARAM_LANGUAGE = 'language';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $allowedFields;

    /**
     * @var array
     */
    protected $requestParams;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        foreach ($params as $name => $value) {
            if (!in_array($name, $this->requestParams) || !is_string($name)) {
                continue;
            }
            $this->{$name} = $value;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $params = [];
        foreach ($this as $name => $value) {
            if (!in_array($name, $this->requestParams) || empty($value)) {
                continue;
            }
            $params[$name] = $value;
        }
        return $params;
    }

    /**
     * @param string $errorCode
     * @return string
     */
    public function getErrorMessage($errorCode)
    {
        return isset($this->errors[$errorCode]) ? $this->errors[$errorCode] : 'Unknown error';
    }

    /**
     * @param array $fields
     * @return bool
     */
    protected function validateFields(array $fields)
    {
        return !array_diff($fields, $this->allowedFields);
    }
}