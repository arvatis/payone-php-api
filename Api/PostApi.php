<?php

namespace Payone\Api;

use Payone\Response\GenericResponse;

/**
 * Class XmlApi
 *
 * @package Payone\Api
 */
class PostApi
{
    /**
     * The URL of the Payone API
     */
    const PAYONE_SERVER_API_URL = 'https://api.pay1.de/post-gateway/';

    /**
     * @var  ClientContract
     */
    protected $client;
    /**
     * @var bool
     */
    protected $testMode;

    /**
     * XmlApi constructor.
     *
     * @param ClientContract $client
     * @param bool $testMode
     */
    public function __construct(ClientContract $client, $testMode = true)
    {
        $this->client = $client;
        $this->testMode = $testMode;
        $client->setEndpointUrl($this->getEndPointUrl());
        $client->setMethod('POST');
        $client->addHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
    }

    /**
     * @return ClientContract
     */
    public function getClient(): ClientContract
    {
        return $this->client;
    }

    /**
     * @param ClientContract $client
     * @return PostApi
     */
    public function setClient(ClientContract $client): PostApi
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param array $data
     * @return GenericResponse
     */
    public function doRequest(array $data)
    {
        $responseBody = $this->client->doRequest($data);
        return new GenericResponse($responseBody);
    }

    /**
     * @return string
     */
    protected function getEndPointUrl(): string
    {
        return $this::PAYONE_SERVER_API_URL;
    }
}
