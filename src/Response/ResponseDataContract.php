<?php

namespace ArvPayoneApi\Response;

interface ResponseDataContract
{
    /**
     * @return array
     */
    public function jsonSerialize();
}
