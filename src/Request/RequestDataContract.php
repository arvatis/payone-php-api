<?php

namespace ArvPayoneApi\Request;

interface RequestDataContract
{
    /**
     * @return array
     */
    public function jsonSerialize();
}
