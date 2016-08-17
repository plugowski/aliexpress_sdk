<?php
namespace AliExpressSDK;

/**
 * Class RequestInvalidFieldException
 * @package AliExpressSDK
 */
class RequestInvalidFieldException extends \Exception
{
    /**
     * RequestInvalidFieldException constructor.
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        parent::__construct(sprintf('Not allowed fields: %s', implode(', ', $fields)));
    }
}