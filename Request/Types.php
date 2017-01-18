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
    static public function getRequestTypes()
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}