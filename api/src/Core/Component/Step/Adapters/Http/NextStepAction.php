<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\NextStepUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NextStepAction extends ApiAction
{
    public function __construct(private NextStepUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $ouptup = $this->useCase->next();
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($ouptup)
        );

        return $res;
    }
}
