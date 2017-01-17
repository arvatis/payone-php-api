<?php
namespace Tests\Payone\Mock\Request;

/**
 * Class DataAbstract
 */
abstract class DataAbstract
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            "aid" => 25027,//"your_account_id",
            "mid" => 24067,//"your_merchant_id",
            "portalid" => 2025425,
            "key" => hash("md5", "sfSTWloDrMtbSZGc"), // the key has to be hashed as md5
            "mode" => "test", // can be "live" for actual transactions
            "api_version" => "3.10",
            "encoding" => "UTF-8"
        ];
    }

}

