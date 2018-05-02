<?php

namespace ArvPayoneApi\Response;

class ResponseDataAbstract
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $result = [];

        $class = new \ReflectionClass(get_class($this));
        foreach ($class->getMethods() as $method) {
            if (substr($method->name, 0, 3) != 'get') {
                continue;
            }
            $propertyName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

            $value = $method->invoke($this);
            if (method_exists($value, 'jsonSerialize')
                && is_callable([$value, 'jsonSerialize'])) {
                $value = $value->jsonSerialize();
            }
            $result[$propertyName] = $value;
        }

        return $result;
    }
}
