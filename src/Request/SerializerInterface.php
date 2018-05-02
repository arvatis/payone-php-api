<?php

namespace ArvPayoneApi\Request;

interface SerializerInterface
{
    /**
     * @param object $object
     *
     * @return array
     */
    public function serialize($object);
}
