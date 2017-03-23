<?php

namespace Payone\Request;

class Types
{
    const PREAUTHORIZATION = 'preauthorization';
    const AUTHORIZATION = 'authorization';
    const CAPTURE = 'capture';

    /**
     * @return mixed
     */
    public static function getRequestTypes()
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}
