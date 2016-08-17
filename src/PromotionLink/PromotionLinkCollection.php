<?php
namespace AliExpressSDK\PromotionLink;

/**
 * Class PromotionLinkCollection
 * @package AliExpressSDK\PromotionLink
 */
class PromotionLinkCollection implements \IteratorAggregate
{

    /**
     * @var array
     */
    private $items = [];

    /**
     * @param PromotionLink $promotionLink
     */
    public function add(PromotionLink $promotionLink)
    {
        $this->items[] = $promotionLink;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}