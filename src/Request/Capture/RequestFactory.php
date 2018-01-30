<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Lib\Version;
use ArvPayoneApi\Request\Capture;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestFactoryContract;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param bool $referenceId
     *
     * @return \ArvPayoneApi\Request\Capture\Capture|\ArvPayoneApi\Request\RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
    {
        $context = $data['context'];
        $config = new Config(
            $context['aid'],
            $context['mid'],
            $context['portalid'],
            $context['key'],
            $context['mode']
        );

        $order = $data['order'];

        $systemInfoData = $data['systemInfo'];
        $systemInfo = new SystemInfo(
            $systemInfoData['vendor'],
            Version::getVersion(),
            $systemInfoData['module'],
            $systemInfoData['module_version']
        );

        return new Capture\Capture(
            $config,
            $referenceId,
            $order['amount'],
            $order['currency'],
            $context['capturemode'],
            $systemInfo,
            $context['sequencenumber']
        );
    }
}
