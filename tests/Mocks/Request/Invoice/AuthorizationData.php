<?php

namespace ArvPayoneApi\Mocks\Request\Invoice;

use ArvPayoneApi\Lib\Version;
use ArvPayoneApi\Mocks\Request\DataAbstract;
use ArvPayoneApi\Mocks\Request\RequestContract;

/**
 * Class AuthorizationData
 */
class AuthorizationData extends DataAbstract implements RequestContract
{
    /**
     * @return array
     */
    public function getRequestData()
    {
        return [
            'request' => 'authorization', // create account receivable
            'clearingtype' => 'rec',
            'reference' => uniqid(), // a unique reference, e.g. order number
            'amount' => 10000, // amount in smallest currency unit, i.e. cents
            'currency' => 'EUR',
            'integrator_name' => 'arvatis media GmbH',
            'integrator_version' => Version::getVersion(),
            'solution_name' => 'plentymarkets 7 Payone plugin',
            'solution_version' => '1',
        ];
    }
}
