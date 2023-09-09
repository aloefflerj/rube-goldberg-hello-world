<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Middlewares;

use Slim\Interfaces\ErrorRendererInterface;

class ErrorRenderer implements ErrorRendererInterface
{
    public function __invoke(\Throwable $th, bool $displayErrorDetails): string
    {
        return json_decode($th->getMessage());
    }
}
