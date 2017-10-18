<?php

use Lavegui\Calendar\Config\Config;
use Slim\App;

require __DIR__ . '/vendor/autoload.php';

$app = new App();
require __DIR__ . '/src/dependencies.php';

return $app->getContainer()->get(Config::class)->db();
