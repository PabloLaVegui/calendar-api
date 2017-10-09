<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Lavegui\Calendar\Config\Config;
use Lavegui\Calendar\Config\YamlConfig;
use Lavegui\Calendar\Controller\UserController;
use Lavegui\Calendar\Infrastructure\Persistence\Doctrine\Repository\DoctrineUserRepository;
use Lavegui\Calendar\Infrastructure\Persistence\Repository\UserRepository;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container[Config::class] = function () {
    $configFilePath = __DIR__ . '/Environment/env.yml';

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
