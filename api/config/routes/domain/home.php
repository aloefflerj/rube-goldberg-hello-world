<?php

use Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain\StepId;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

/** @var App $app */
$app->get('/', function (RequestInterface $req, ResponseInterface $res, array $args) {
    dd(StepId::new());
    $res->getBody()->write("hello");
    return $res;
});