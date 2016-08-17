<?php
namespace AliExpressSDK;

/**
 * Class PromotionLinksToManyArguments
 * @package AliExpressSDK\PromotionLink
 */
class RequestTooManyArgumentsException extends \Exception
{
    /**
     * PromotionLinksToManyArguments constructor.
     * @param int $number
     */
    public function __construct($number)
    {
        parent::__construct(sprintf('Try to set too many arguments. Maximum allowed number is 50, try to set %d.', $number));
    }
}