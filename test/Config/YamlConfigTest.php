<?php
namespace Lavegui\Calendar\Test\Config;

use Lavegui\Calendar\Config\YamlConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class YamlConfigTest
 * @package Lavegui\Calendar\Test\Config
 */
class YamlConfigTest extends TestCase
{
    /** @test */
    public function project_base_path_go_before_config_mapping_config_path()
    {
        $yamlConfig = new YamlConfig(__DIR__ . '/../fixtures/config_test.yml');
        $expected = [ getcwd() . '/src/Config/../MappingPath' ];

        $this->assertEquals($expected, $yamlConfig->mappingPaths());
    }
}
