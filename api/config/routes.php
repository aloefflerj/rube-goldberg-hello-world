<?php

/** @var \Slim\App $app */

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->get('/', function (RequestInterface $req, ResponseInterface $res, array $args) {
    $res->getBody()->write("hello");
    return $res;
});

$app->group('/particles', function (RouteCollectorProxyInterface $group) {
    $group->get('[/]', FetchParticlesAction::class);
    $group->get('/{id}[/]', FindParticleAction::class);
    $group->post('[/]', CreateParticleAction::class);
});
