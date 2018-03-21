<?php

namespace ArvPayoneApi\Request\Parts;

class RedirectUrls
{
    /**
     * @var string
     */
    private $success;
    /**
     * @var string
     */
    private $error;

    /**
     * @var string
     */
    private $back;

    /**
     * RedirectUrls constructor.
     *
     * @param string $success
     * @param string $error
     * @param string $back
     */
    public function __construct($success, $error, $back)
    {
        $this->success = $success;
        $this->error = $error;
        $this->back = $back;
    }

    /**
     * Getter for Success
     *
     * @return string
     */
    public function getSuccessurl()
    {
        return $this->success;
    }

    /**
     * Getter for Error
     *
     * @return string
     */
    public function getErrorurl()
    {
        return $this->error;
    }

    /**
     * Getter for Back
     *
     * @return string
     */
    public function getBackurl()
    {
        return $this->back;
    }
}
