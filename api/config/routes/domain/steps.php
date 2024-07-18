<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\FetchStepsAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\FetchStepSpeechesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\NextStepAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$app->group('/steps', function (RouteCollectorProxyInterface $group) {
    StackLogger::sendStatically();
    $group->get('[/]', FetchStepsAction::class);
    $group->get('/{id}/speeches', FetchStepSpeechesAction::class);
    $group->post('/next', NextStepAction::class);
});