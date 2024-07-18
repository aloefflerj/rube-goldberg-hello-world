<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchSpeechesByStepDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepSpeechesUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepsUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FetchStepSpeechesAction extends ApiAction
{
    public function __construct(private FetchStepSpeechesUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $input = new FetchSpeechesByStepDTO($args['id']);
        $ouptup = $this->useCase->findByStep($input);
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($ouptup)
        );

        return $res;
    }
}
