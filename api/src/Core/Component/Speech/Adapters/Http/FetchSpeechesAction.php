<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\Boundaries\FetchSpeechesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\FetchSpeechesUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FetchSpeechesAction extends ApiAction
{
    public function __construct(private FetchSpeechesUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $input = new FetchSpeechesDTO('order');
        $ouptup = $this->useCase->fetchAll($input);
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($ouptup)
        );

        return $res;
    }
}
