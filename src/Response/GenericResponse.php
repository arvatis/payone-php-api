<?php

namespace ArvPayoneApi\Response;

/**
 * Class XmlApiResponse
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
    public function __construct($responseString)
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
        if (!$this->responseData || $this->getStatus() == 'ERROR') {
            return false;
        }

        return true;
    }

    /**
     * Get full error description from response
     *
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->getSuccess()) {
            return '';
        }

        $response = 'empty response';
        if ($this->responseData) {
            $response = print_r($this->responseData, true);
        }

        return 'Payone returned an error: ' . $response;
    }

    /**
     * Get the transaction id
     *
     * @return string
     */
    public function getTransactionID()
    {
        if (!isset($this->responseData['txid'])) {
            return '';
        }

        return (string) $this->responseData['txid'];
    }

    /**
     * Getter for ResponseData
     *
     * @return array
     */
    public function getResponseData()
    {
        return $this->responseData;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if (!isset($this->responseData['status'])) {
            return '';
        }

        return (string) $this->responseData['status'];
    }

    /**
     * @param string $response
     *
     * @return array
     */
    private function parseResponse($response)
    {
        $separator = "\n\t";
        $line = strtok($response, $separator);

        while ($line !== false) {
            $this->parseLine($line);
            $line = strtok($separator);
        }

        return $this->responseData;
    }

    /**
     * @param string $line
     */
    private function parseLine($line)
    {
        if (!trim($line)) {
            return;
        }
        list($key, $value) = explode('=', $line, 2);

        $this->responseData[trim($key)] = trim($value);
    }
}
