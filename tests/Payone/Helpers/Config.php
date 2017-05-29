<?php

namespace Tests\Payone\Helpers;

/**
 * Class Config
 */
class Config
{
    /**
     * Return config from phpunit.ini file
     *
     * @throws \Exception
     *
     * @return array
     */
    public static function getConfig()
    {
        $configFile = 'phpunit.ini';
        if (!file_exists($configFile) || !is_readable($configFile)) {
            throw new \Exception('Please create a config file "phpunit.ini". See "phpunit.ini.dist" for reference.');
        }

        $config = parse_ini_file($configFile, true);

        return $config;
    }
}
