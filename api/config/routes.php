<?php

/** @var \Slim\App $app */

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->get('/', function (RequestInterface $req, ResponseInterface $res, array $args) {
    $res->getBody()->write("hello");
    return $res;
});

$app->group('/fakeUser', function (RouteCollectorProxyInterface $group) {
    $group->get('/{id}', function (RequestInterface $req, ResponseInterface $res, array $args) {
        $res->getBody()->write("fake user id {$args['id']}");
        return $res;
    });
});
