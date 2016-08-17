<?php
namespace AliExpressSDK\PromotionLink;

use AliExpressSDK\Request;
use AliExpressSDK\RequestInvalidFieldException;
use AliExpressSDK\RequestTooManyArgumentsException;

/**
 * Class PromotionLinksRequest
 * @package AliExpressSDK\PromotionLink
 */
class PromotionLinksRequest extends Request
{
    /**
     * @var string
     */
    protected $name = 'getPromotionLinks';

    /**
     * @var array
     */
    protected $allowedFields = [
        self::FIELD_URL,
        self::FIELD_PROMOTION_URL,
        self::FIELD_PUBLISHER_ID,
        self::FIELD_TRACKING_ID,
        self::FIELD_TOTAL_RESULTS,
        self::FIELD_LOCAL_PRICE
    ];

    /**
     * @var array
     */
    protected $requestParams = [
        self::PARAM_FIELDS,
        self::PARAM_URLS,
        self::PARAM_TRACKING_ID
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
        20030070 => 'Tracking ID input parameter error',
        20030080 => 'URL input parameter error or beyond the maximum number of the URLs',
    ];

    /**
     * @var string
     */
    protected $fields;

    /**
     * @var array
     */
    protected $urls;

    /**
     * @var string
     */
    protected $trackingId;

    /**
     * PromotionLinksRequest constructor.
     */
    public function __construct()
    {
        $this->fields = implode(',', $this->allowedFields);
    }

    /**
     * @param string $trackingId
     * @return $this
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = $trackingId;
        return $this;
    }

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
     * @param array $urls
     * @return $this
     * @throws RequestTooManyArgumentsException
     */
    public function setUrls(array $urls)
    {
        if (count($urls) > 50) {
            throw new RequestTooManyArgumentsException(count($urls));
        }
        $this->urls = implode(',', $urls);
        return $this;
    }
}