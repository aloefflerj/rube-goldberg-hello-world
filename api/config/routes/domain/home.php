<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

/** @var App $app */
$app->get('/', function (RequestInterface $req, ResponseInterface $res, array $args) {
    $res->getBody()->write("hello");
    return $res;
});