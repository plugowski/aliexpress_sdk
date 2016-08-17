<?php
namespace AliExpressSDK;

/**
 * Class ProductPrice
 * @package AliExpressSDK
 */
class ProductPrice
{
    /**
     * @var string
     */
    private $localPrice;
    /**
     * @var string
     */
    private $originalPrice;
    /**
     * @var string
     */
    private $salePrice;
    /**
     * @var string
     */
    private $discount;
    /**
     * @var int
     */
    private $evaluateScore;
    /**
     * @var string
     */
    private $commission;
    /**
     * @var string
     */
    private $commissionRate;
    /**
     * @var string
     */
    private $monthCommission;

    /**
     * Price constructor.
     * @param string $localPrice
     * @param string $originalPrice
     * @param string $salePrice
     * @param string $discount
     * @param int $evaluateScore
     * @param string $commission
     * @param string $commissionRate
     * @param string $monthCommission
     */
    public function __construct($localPrice, $originalPrice, $salePrice, $discount, $evaluateScore, $commission, $commissionRate, $monthCommission)
    {
        $this->localPrice = $localPrice;
        $this->originalPrice = $originalPrice;
        $this->salePrice = $salePrice;
        $this->discount = $discount;
        $this->evaluateScore = $evaluateScore;
        $this->commission = $commission;
        $this->commissionRate = $commissionRate;
        $this->monthCommission = $monthCommission;
    }

    /**
     * @return string
     */
    public function getLocalPrice()
    {
        return $this->localPrice;
    }

    /**
     * @return string
     */
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    /**
     * @return string
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return int
     */
    public function getEvaluateScore()
    {
        return $this->evaluateScore;
    }

    /**
     * @return string
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @return string
     */
    public function getCommissionRate()
    {
        return $this->commissionRate;
    }

    /**
     * @return string
     */
    public function getMonthCommission()
    {
        return $this->monthCommission;
    }
}