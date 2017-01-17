<?php

namespace Payone\Api;

/**
 * Interface ClientContract
 *
 * @package Payone\Api
 */
interface ClientContract
{
    /**
     * @param array $data
     * @return string
     */
    public function doRequest(array $data);

    /**
     * @param string $method
     * @return void
     */
    public function setMethod($method);

    /**
     * @param string $url
     * @return void
     */
    public function setEndpointUrl($url);

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addHeader($key, $value);
}
