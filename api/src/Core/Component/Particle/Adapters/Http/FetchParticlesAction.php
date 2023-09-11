<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\FetchParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLoggerSendMessageDAO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FetchParticlesAction extends ApiAction
{
    public function __construct(private FetchParticlesUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        $stackLogger = new StackLogger();
        $stackLogger->send(
            new StackLoggerSendMessageDAO(
                'StackLoggger',
                (new \ReflectionClass($this))->getShortName(),
                'dispatch',
                'Controller'
            )
        );
        $input = new FetchParticlesDTO('id');
        $output = $this->useCase->fetchAll($input);
        $stackLogger->send(
            new StackLoggerSendMessageDAO(
                'StackLoggger',
                (new \ReflectionClass($this))->getShortName(),
                'dispatch',
                'Controller'
            )
        );

        $res->getBody()->write(
            json_encode($output)
        );

        return $res;
    }
}
