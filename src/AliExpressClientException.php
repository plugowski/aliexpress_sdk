<?php
namespace AliExpressSDK;

/**
 * Class AliExpressClientException
 * @package AliExpressSDK
 */
class AliExpressClientException extends \Exception
{
    /**
     * AliExpressSDKException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}