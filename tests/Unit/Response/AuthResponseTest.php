<?php

namespace ArvPayoneApi\Unit\Response;

use ArvPayoneApi\Response\ResponseContract;
use ArvPayoneApi\Response\ResponseFactory;

class AuthResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResponseContract
     */
    private $resource;

    public function setUp()
    {
        $authResponse = <<<TEXT
status=APPROVED
txid=1234
userid=1234
clearing_bankaccount=0022520120
clearing_bankcode=21070020
clearing_bankcountry=DE
clearing_bankname=Deutsche Bank AG
clearing_bankaccountholder=BS PAYONE GmbH
clearing_bankcity=Kiel
clearing_bankiban=DE87210700200022520120
clearing_bankbic=DEUTDEHH210
TEXT;

        $this->resource = ResponseFactory::create($authResponse);
    }

    public function testResponseHasClearingData()
    {
        $data = $this->resource->jsonSerialize();
        self::assertTrue(isset($data['clearing']['bankaccount']));
    }
}
