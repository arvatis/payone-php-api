<?php

namespace Payone\Response;

class ResponseAbstract
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        $class = new \ReflectionClass(get_class($this));
        foreach ($class->getMethods() as $method) {
            if (substr($method->name, 0, 3) == 'get') {
                $propertyName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

                $result[$propertyName] = $method->invoke($this);
            }
        }

        return $result;
    }
}
