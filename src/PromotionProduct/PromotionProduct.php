<?php
namespace AliExpressSDK\PromotionProduct;

use AliExpressSDK\ProductPrice;

/**
 * Class PromotionProduct
 * @package AliExpressSDK\PromotionProduct
 */
class PromotionProduct
{
    /**
     * @var ProductPrice
     */
    private $price;
    /**
     * @var int
     */
    private $productId;
    /**
     * @var string
     */
    private $productTitle;
    /**
     * @var string
     */
    private $productUrl;
    /**
     * @var string
     */
    private $imageUrl;
    /**
     * @var int
     */
    private $volume;
    /**
     * @var string
     */
    private $packageType;
    /**
     * @var int
     */
    private $lotNum;
    /**
     * @var string
     */
    private $validTime;

    /**
     * PromotionProduct constructor.
     * @param int $productId
     * @param string $productTitle
     * @param string $productUrl
     * @param string $imageUrl
     * @param int $volume
     * @param string $packageType
     * @param int $lotNum
     * @param string $validTime
     * @param ProductPrice $productPrice
     */
    public function __construct($productId, $productTitle, $productUrl, $imageUrl, $volume, $packageType, $lotNum, $validTime, ProductPrice $productPrice)
    {
        $this->productId = $productId;
        $this->productTitle = $productTitle;
        $this->productUrl = $productUrl;
        $this->imageUrl = $imageUrl;
        $this->volume = $volume;
        $this->packageType = $packageType;
        $this->lotNum = $lotNum;
        $this->validTime = $validTime;
        $this->price = $productPrice;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductTitle()
    {
        return $this->productTitle;
    }

    /**
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return string
     */
    public function getPackageType()
    {
        return $this->packageType;
    }

    /**
     * @return int
     */
    public function getLotNum()
    {
        return $this->lotNum;
    }

    /**
     * @return string
     */
    public function getValidTime()
    {
        return $this->validTime;
    }

    /**
     * @return ProductPrice
     */
    public function getPrice()
    {
        return $this->price;
    }
}