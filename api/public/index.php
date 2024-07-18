<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/env.php';

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../config/di/main.php';

$app = AppFactory::createFromContainer($container);

require_once __DIR__ . '/../config/errors.php';
require_once __DIR__ . '/../config/routes.php';

$app->run();
