<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Lavegui\Calendar\Action\Support\CreateSupportAction;
use Lavegui\Calendar\Action\Support\CreateSupportRequestValidator;
use Lavegui\Calendar\Config\Config;
use Lavegui\Calendar\Config\YamlConfig;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container[Config::class] = function () {
    $configFilePath = __DIR__ . '/../environment/env.yml';

    return new YamlConfig($configFilePath);
};

$container[EntityManager::class] = function (ContainerInterface $container) {
    $config = $container->get(Config::class);

    $mappingConfig = Setup::createYAMLMetadataConfiguration(
        $config->mappingPaths(),
        $config->isDevMode()
    );
    $dbParams = $config->db();

    return EntityManager::create($dbParams, $mappingConfig);
};

$container[CreateSupportAction::class] = function () {
    return new CreateSupportAction(
        new CreateSupportRequestValidator()
    );
};
