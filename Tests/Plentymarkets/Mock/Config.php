<?php
namespace Payone\Mocks;

/**
 * Class Config
 */
class Config
{
    /**
     * @return \stdClass[]
     */
    private $config = [];

    /**
     * Getter for Config
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Config constructor.
     */
    public function __construct()
    {

        $configJson = file_get_contents(realpath(__DIR__ . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR .
            'config.json'));
        $config = json_decode($configJson);
        foreach ($config as $confEntry) {
            $this->config[$confEntry->key] = $confEntry;
        }
    }
}