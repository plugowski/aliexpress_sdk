<?php
namespace AliExpressSDK;

/**
 * Class Request
 * @package AliExpressSDK
 */
abstract class Request extends RequestDictionary
{
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