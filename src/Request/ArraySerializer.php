<?php

namespace ArvPayoneApi\Request;

class ArraySerializer implements SerializerInterface
{
    /**
     * @param object $object
     *
     * @throws \ReflectionException
     *
     * @return array
     */
    public function serialize($object)
    {
        if ($object instanceof \JsonSerializable) {
            /** @var \JsonSerializable $object */
            $result = $object->jsonSerialize();
            asort($result);
            return $result;
        }

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
            if ($value !== null && $value !== '') {
                $result[$propName] = $value;
            }
        }

        asort($result);

        return $result;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
