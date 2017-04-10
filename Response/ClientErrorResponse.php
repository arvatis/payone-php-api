<?php

namespace Payone\Response;

/**
 * Class ClientErrorResponse
 */
class ClientErrorResponse extends ResponseAbstract implements ResponseContract
{
    /** @var string */
    private $message;

    /**
     * ClientErrorResponse constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getTransactionID(): string
    {
        return '';
    }
}
