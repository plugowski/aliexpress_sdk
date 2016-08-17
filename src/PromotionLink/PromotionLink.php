<?php
namespace AliExpressSDK\PromotionLink;

/**
 * Class PromotionLink
 * @package AliExpressSDK\PromotionLink
 */
class PromotionLink
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $promotionUrl;

    /**
     * PromotionLink constructor.
     * @param string $url
     * @param string $promotionUrl
     */
    public function __construct($url, $promotionUrl)
    {
        $this->url = $url;
        $this->promotionUrl = $promotionUrl;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPromotionUrl()
    {
        return $this->promotionUrl;
    }
}