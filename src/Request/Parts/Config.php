<?php

namespace ArvPayoneApi\Request\Parts;

use ArvPayoneApi\Request\RequestDataContract;

class Config implements RequestDataContract
{
    private $aid;
    private $mid;
    private $portalid;
    private $key;
    private $mode;
    private $apiVersion = '3.10';
    private $encoding = 'UTF-8';

    /**
     * Config constructor.
     *
     * @param string $aid
     * @param string $mid
     * @param string $portalid
     * @param string $key
     * @param string $mode live|test
     */
    public function __construct($aid, $mid, $portalid, $key, $mode)
    {
        $this->aid = $aid;
        $this->mid = $mid;
        $this->portalid = $portalid;
        $this->key = hash('md5', $key);
        $this->mode = $mode;
    }

    /**
     * Getter for Aid
     *
     * @return mixed
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Getter for Mid
     *
     * @return mixed
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * Getter for Portalid
     *
     * @return mixed
     */
    public function getPortalid()
    {
        return $this->portalid;
    }

    /**
     * Getter for Key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Getter for Mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Getter for Encoding
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Getter for ApiVersion
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }
}
