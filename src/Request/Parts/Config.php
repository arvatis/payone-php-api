<?php

namespace Payone\Request\Parts;

use Payone\Request\RequestDataContract;

class Config implements RequestDataContract
{
    private $aid;
    private $mid;
    private $portalid;
    private $key;
    private $mode;

    /**
     * Config constructor.
     *
     * @param $aid
     * @param $mid
     * @param $portalid
     * @param $key
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

    public function toArray()
    {
        return [
            'aid' => $this->aid,
            'mid' => $this->mid, //"your_merchant_id",
            'portalid' => $this->portalid,
            'key' => $this->key, // the key has to be hashed as md5
            'mode' => $this->mode, // can be "live" for actual transactions
            'api_version' => '3.10',
            'encoding' => 'UTF-8',
        ];
    }
}
