<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'vendor/autoload.php';

$app = new Slim\App();
require __DIR__ . '/src/dependencies.php';
$container = $app->getContainer();

$entityManager = $container->get(EntityManager::class);

return ConsoleRunner::createHelperSet($entityManager);
