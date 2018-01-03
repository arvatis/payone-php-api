<?php

namespace ArvPayoneApi\Request;

class ArraySerializer implements SerializerInterface
{
    public function serialize($object)
    {
        $oClass = new \ReflectionClass(get_class($object));
        $result = [];
        foreach ($oClass->getMethods() as $method) {
            if (substr($method->name, 0, 3) != 'get') {
                continue;
            }
            $propName = $this->camelCaseToUnderscore(substr($method->name, 3));

            $value = $method->invoke($object);
            if (is_object($value)) {
                $result += $this->serialize($value);
                continue;
            }
            if ($value) {
                $result[$propName] = $value;
            }
        }

        asort($result);

        return $result;
    }

    /**
     * @param $string
     *
     * @return string
     */
    private function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
