<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Adapters\Http\FetchSpeechesAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$app->group('/speeches', function (RouteCollectorProxyInterface $group) {
    StackLogger::sendStatically();
    $group->get('[/]', FetchSpeechesAction::class);
});