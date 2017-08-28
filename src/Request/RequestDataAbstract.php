<?php


namespace ArvPayoneApi\Request;


class RequestDataAbstract implements \JsonSerializable
{

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $oClass = new \ReflectionClass(get_class($this));
        $result = [];
        foreach ($oClass->getMethods() as $method) {
            if ($method == 'jsonSerialize') {
                continue;
            }

            if (substr($method->name, 0, 3) == 'get') {
                $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

                $value = $method->invoke($this);
                if (is_object($value)) {
                    $result += $value->jsonSerialize();
                    continue;
                }
                $result[$propName] = $value;
            }
        }

        asort($result);
        return $result;
    }
}