<?php
namespace Lavegui\Calendar\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfig
 * @package Lavegui\Calendar\Config
 */
class YamlConfig implements Config
{
    /** @var array */
    private $config;

    /**
     * @param string $configFilePath
     */
    public function __construct($configFilePath)
    {
        $this->config = Yaml::parse(file_get_contents($configFilePath));
        $this->setMappingPaths();
    }

    /**
     * @return bool
     */
    public function isDevMode()
    {
        return $this->config['devMode'];
    }

    /**
     * @return array
     */
    public function db()
    {
        return $this->config['db'];
    }

    /**
     * @return array
     */
    public function mappingPaths()
    {
        return $this->config['doctrine']['mappingPaths'];
    }

    /**
     * @return void
     */
    private function setMappingPaths()
    {
        $this->config['doctrine']['mappingPaths'] = array_map(
            function ($relativeMappingPath) {
                return $this->getBasePath() . $relativeMappingPath;
            },
            $this->config['doctrine']['mappingPaths']
        );
    }

    /**
     * @return string
     */
    private function getBasePath()
    {
        return __DIR__ . '/../';
    }
}
