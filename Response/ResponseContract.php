<?php

namespace Payone\Response;

/**
 * Class XmlApiResponse
 */
interface ResponseContract
{
    /**
     * Request success
     *
     * @return bool
     */
    public function getSuccess(): bool;

    /**
     * Get full error description from response
     *
     * @return string
     */
    public function getErrorMessage(): string;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * Get the transaction id
     *
     * @return string
     */
    public function getTransactionID(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
