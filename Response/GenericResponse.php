<?php

namespace Payone\Response;

/**
 * Class XmlApiResponse
 *
 * @package Payone\Api
 */
class GenericResponse implements ResponseContract
{
    /**
     * @var array
     */
    private $responseData = [];

    /**
     * XmlApiResponse constructor.
     *
     * @param string $responseString
     */
    public function __construct(string $responseString)
    {
        $this->responseArray = $this->parseResponse($responseString);
    }

    /**
     * Request success
     *
     * @return bool
     */
    public function getSuccess()
    {
        if ($this->responseData['status'] == "ERROR") {
            return false;
        }

        return true;
    }

    /**
     * Get full error description from response
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->getSuccess()) {
            return '';
        }

        return "Payone returned an error:\n" . print_r($this->responseData, true);
    }

    /**
     * Get the transaction id
     * @return string
     */
    public function getTransactionID()
    {
        return (string) $this->responseData['txid'];
    }

    /**
     * @param string $response
     * @return array
     */
    private function parseResponse(string $response)
    {
        $responseLines = explode(PHP_EOL, $response);
        foreach ($responseLines as $line) {
            $keyValue = explode("=", $line);
            if (trim($keyValue[0]) == "") {
                continue;
            }
            if (count($keyValue) == 2) {
                $this->responseData[$keyValue[0]] = trim($keyValue[1]);
            } else {
                $key = $keyValue[0];
                unset($keyValue[0]);
                $value = implode("=", $keyValue);
                $this->responseData[$key] = $value;
            }

        }
        return $this->responseData;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return (string) $this->responseData['status'];
    }
}
