<?php

namespace Payone\Request;

interface RequestDataContract
{
    /**
     * @return array
     */
    public function toArray();
}
