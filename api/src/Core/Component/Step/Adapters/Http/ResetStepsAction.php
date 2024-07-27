<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\ResetStepsUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ResetStepsAction extends ApiAction
{
    public function __construct(private ResetStepsUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $ouptup = $this->useCase->reset();
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($ouptup)
        );

        return $res;
    }
}
