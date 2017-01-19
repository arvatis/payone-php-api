<?php
namespace Payone\Response;


/**
 * Class XmlApiResponse
 *
 * @package Payone\Api
 */
interface ResponseContract
{
    /**
     * Request success
     *
     * @return bool
     */
    public function getSuccess();

    /**
     * Get full error description from response
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * Get the transaction id
     * @return string
     */
    public function getTransactionID();

    /**
     * @return array
     */
    public function toArray();

}