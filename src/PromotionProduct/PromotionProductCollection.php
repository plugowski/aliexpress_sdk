<?php
namespace AliExpressSDK\PromotionProduct;

/**
 * Class PromotionProductCollection
 * @package AliExpressSDK\PromotionProduct
 */
class PromotionProductCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @param PromotionProduct $promotionProduct
     */
    public function add(PromotionProduct $promotionProduct)
    {
        $this->items[] = $promotionProduct;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}