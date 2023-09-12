<?php

/** @var \Slim\App $app */

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->get('/', function (RequestInterface $req, ResponseInterface $res, array $args) {
    $res->getBody()->write("hello");
    return $res;
});

$app->group('/particles', function (RouteCollectorProxyInterface $group) {
    StackLogger::sendStatically();
    $group->get('[/]', FetchParticlesAction::class);
    $group->get('/{id}[/]', FindParticleAction::class);
    $group->post('[/]', CreateParticleAction::class);
    StackLogger::sendStatically();
});
