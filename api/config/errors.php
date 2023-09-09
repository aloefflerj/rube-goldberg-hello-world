<?php

/** @var \Slim\App $app */

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions\Contracts\HttpRouteException;
// use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Middlewares\ApiErrorHandler;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpException;

$app->addRoutingMiddleware();

// REFACTOR: add custom error hanlder class (ApiErrorHandler)
$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $th,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails,
    ?LoggerInterface $logger = null
) use ($app) {
    if ($logger) {
        $logger->error($th->getMessage());
    }

    $statusCode = 500;
    $payload = new \stdClass();
    $payload->status = 500;
    $payload->msg = 'Internal server error.';
    if ($logErrorDetails) $payload->details = $th->getTraceAsString();


    if ($th instanceof HttpRouteException || $th instanceof HttpException) {
        $statusCode = $th->getCode();

        $payload->status = $th->getCode();
        $payload->msg = $th->getMessage();
    }

    $response = $app->getResponseFactory()->createResponse($statusCode);
    $response->getBody()->write(
        json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE
        )
    );

    return $response;
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
