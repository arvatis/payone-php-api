<?php

namespace ArvPayoneApi\Api;

use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\SerializerInterface;
use ArvPayoneApi\Response\ClientErrorResponse;
use ArvPayoneApi\Response\ResponseContract;
use ArvPayoneApi\Response\ResponseFactory;

/**
 * Class PostApi
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
    private $serializer;

    /**
     * PostApi constructor.
     *
     * @param ClientContract $client
     * @param SerializerInterface $serializer
     */
    public function __construct(ClientContract $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
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
     *
     * @return PostApi
     */
    public function setClient(ClientContract $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param RequestDataContract $data
     *
     * @return ResponseContract
     */
    public function doRequest(RequestDataContract $data)
    {
        try {
            $serializedData = $this->serializer->serialize($data);
            $responseBody = $this->client->doRequest($serializedData);

            return ResponseFactory::create($responseBody);
        } catch (\Exception $e) {
        }

        return new ClientErrorResponse($e->getMessage());
    }

    /**
     * @return string
     */
    protected function getEndPointUrl()
    {
        return $this::PAYONE_SERVER_API_URL;
    }
}
