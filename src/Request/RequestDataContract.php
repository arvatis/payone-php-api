<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;

/**
 * Class GenericRequest
 */
interface RequestDataContract
{
    /**
     * Getter for Sequencenumber
     */
    public function getSequencenumber();

    /**
     * Getter for Amount
     *
     * @return int
     */
    public function getAmount();

    /**
     * Getter for Currency
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Getter for Config
     *
     * @return Config
     */
    public function getConfig();

    /**
     * @return string
     */
    public function getRequest();

    /**
     * Getter for Info
     *
     * @return SystemInfo
     */
    public function getInfo();
}
