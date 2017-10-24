<?php

namespace ArvPayoneApi\Api;

use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Response\ClientErrorResponse;
use ArvPayoneApi\Response\ResponseContract;
use ArvPayoneApi\Response\ResponseFactory;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**
 * Class XmlApi
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
     *
     * @return PostApi
     */
    public function setClient(ClientContract $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return ResponseContract
     */
    public function doRequest(RequestDataContract $data)
    {
        try {
            $responseBody = $this->client->doRequest($data->jsonSerialize());

            return ResponseFactory::create($responseBody);
        } catch (ClientException $e) {
        } catch (ServerException $e) {
        } catch (BadResponseException $e) {
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
