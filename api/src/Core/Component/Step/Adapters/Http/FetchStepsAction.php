<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchStepsDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepsUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FetchStepsAction extends ApiAction
{
    public function __construct(private FetchStepsUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $input = new FetchStepsDTO('order');
        $ouptup = $this->useCase->fetchAll($input);
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($ouptup)
        );

        return $res;
    }
}
