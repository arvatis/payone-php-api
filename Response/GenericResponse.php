<?php

namespace Payone\Response;

/**
 * Class XmlApiResponse
 *
 * @package Payone\Api
 */
class GenericResponse extends ResponseAbstract implements ResponseContract
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
        $this->responseData = $this->parseResponse($responseString);
    }

    /**
     * Request success
     *
     * @return bool
     */
    public function getSuccess()
    {
        if (!$this->responseData || $this->getStatus() == "ERROR") {
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

        return "Payone returned an error: " . ($this->responseData ?
                print_r($this->responseData, true) : 'empty response');
    }

    /**
     * Get the transaction id
     * @return string
     */
    public function getTransactionID()
    {
        return isset($this->responseData['txid']) ? (string)$this->responseData['txid'] : '';
    }

    /**
     * Getter for ResponseData
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * @param string $response
     * @return array
     */
    private function parseResponse(string $response)
    {
        $separator = "\n\t";
        $line = strtok($response, $separator);

        while ($line !== false) {
            $keyValue = explode("=", $line, 2);
            if (!trim($keyValue[0])) {
                continue;
            }
            $this->responseData[$keyValue[0]] = isset($keyValue[1]) ? trim($keyValue[1]) : '';
            $line = strtok($separator);
        }
        return $this->responseData;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return isset($this->responseData['status']) ? (string)$this->responseData['status'] : '';
    }


}
