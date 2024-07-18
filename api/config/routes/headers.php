<?php

use Slim\App;
use Slim\Exception\HttpNotFoundException;

/** @var App $app */
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});
