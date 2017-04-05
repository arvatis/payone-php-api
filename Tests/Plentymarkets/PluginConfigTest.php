<?php

namespace Payone\Tests\Unit;

class PluginConfigTest extends \PHPUnit_Framework_TestCase
{
    private $pluginConfig;

    public function setUp()
    {
        $configJson = file_get_contents(
            realpath(__DIR__ . DIRECTORY_SEPARATOR
                . '..' . DIRECTORY_SEPARATOR
                . '..' . DIRECTORY_SEPARATOR
                . '..' . DIRECTORY_SEPARATOR
                . '..' . DIRECTORY_SEPARATOR
                . '..' . DIRECTORY_SEPARATOR .
                'plugin.json')
        );
        $this->pluginConfig = json_decode($configJson, true);
        if (!$this->pluginConfig) {
            throw new \Exception('Plugin config can not be parsed.');
        }
    }

    public function testRequiredFieldsPresent()
    {
        $this->assertArrayHasKey('namespace', $this->pluginConfig);
        $this->assertArrayHasKey('type', $this->pluginConfig);
        $this->assertArrayHasKey('version', $this->pluginConfig);
        $this->assertArrayHasKey('pluginIcon', $this->pluginConfig);
        $this->assertArrayHasKey('price', $this->pluginConfig);
        $this->assertArrayHasKey('description', $this->pluginConfig);
        $this->assertArrayHasKey('namespace', $this->pluginConfig);
        $this->assertArrayHasKey('shortDescription', $this->pluginConfig);
        $this->assertArrayHasKey('categories', $this->pluginConfig);
        $this->assertArrayHasKey('author', $this->pluginConfig);
        $this->assertArrayHasKey('authorIcon', $this->pluginConfig);
    }

    public function testRequiredFieldsTypes()
    {
        $this->assertTrue(is_float($this->pluginConfig['price']));
    }
}
