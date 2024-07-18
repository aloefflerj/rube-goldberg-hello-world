<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$app->group('/particles', function (RouteCollectorProxyInterface $group) {
    StackLogger::sendStatically();
    $group->get('[/]', FetchParticlesAction::class);
    $group->get('/{id}[/]', FindParticleAction::class);
    $group->post('[/]', CreateParticleAction::class);
});
