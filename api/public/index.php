<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Aloefflerj\UniverseOriginApi\Core\Component\Domain\Particle\Particle;
use Slim\Factory\AppFactory;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Particle\ParticleId;

$app = AppFactory::create();

require_once __DIR__ . '/../config/routes.php';

$particleId = ParticleId::generate();
$particle = new Particle($particleId);
dd($particle);

$app->run();
