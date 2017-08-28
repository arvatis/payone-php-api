<?php

namespace ArvPayoneApi\Lib;

/**
 * Class Version
 */
class Version
{
    /**
     * @return string
     */
    public static function getVersion()
    {
        $content = file_get_contents(__DIR__ . '/../../composer.json');
        $content = json_decode($content, true);

        return $content['version'] ?? '';
    }
}
