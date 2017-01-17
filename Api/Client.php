<?php

namespace Payone\Api;

/**
 * Class Client
 *
 * @package Payone\Api
 */
class Client implements ClientContract
{
    /**
     * @var  string
     */
    protected $url;
    /**
     * @var  string
     */
    protected $client;
    /**
     * @var  string
     */
    protected $httpMethod;
    /**
     * @var  string[]
     */
    protected $headers;

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @return Client
     */
    public function setClient(\GuzzleHttp\Client $client): Client
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     * @return Client
     */
    public function setHttpMethod(string $httpMethod): Client
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndpointUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Client
     */
    public function setEndpointUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param array $data
     * @return string
     */
    public function doRequest(array $data)
    {
        $res = $this->client->request(
            $this->getHttpMethod(),
            $this->getEndpointUrl(),
            [
                'form_params' => $data,
                'headers' => $this->headers,
            ]
        );

        return (string)$res->getBody();
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->httpMethod = $method;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addHeader($key, $value)
    {
        if (!$this->headers) {
            $this->headers = [];
        }
        $this->headers[$key] = $value;
    }
}
