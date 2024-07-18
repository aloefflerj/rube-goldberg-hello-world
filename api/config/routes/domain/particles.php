<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Slim\Exception\HttpNotFoundException;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->group('/particles', function (RouteCollectorProxyInterface $group) {
    StackLogger::sendStatically();
    $group->get('[/]', FetchParticlesAction::class);
    $group->get('/{id}[/]', FindParticleAction::class);
    $group->post('[/]', CreateParticleAction::class);
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});
