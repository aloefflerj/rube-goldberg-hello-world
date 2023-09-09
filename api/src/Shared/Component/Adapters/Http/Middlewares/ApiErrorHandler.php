<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Middlewares;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions\Contracts\HttpRouteException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Handlers\ErrorHandler as SlimErrorHandler;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Response;

class ApiErrorHandler extends SlimErrorHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        \Throwable $th,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface {
        $streamFactory = new StreamFactory();
        
        if ($th instanceof HttpRouteException) {
            return new Response(
                $th->getMessage(),
                null,
                $streamFactory->createStream(
                    json_encode([
                        'code' => $th->getCode(),
                        'message' => $th->getMessage()
                    ])
                )
            );
        }

        return new Response(
            500,
            null,
            $streamFactory->createStream(
                json_encode([
                    'code' => 500,
                    'message' => 'Internal Server Error'
                ])
            )
        );
    }

    protected function logError(string $error): void
    {
        dd($error);
        // echo $error;
    }
}
