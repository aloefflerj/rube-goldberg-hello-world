<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\CreateParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\CreateParticleUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateParticleAction extends ApiAction
{
    public function __construct(private CreateParticleUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        StackLogger::sendStatically();
        $body = json_decode($req->getBody()->getContents());
        
        $this->requiredBodyField($body, 'charge');

        $output = $this->useCase->createOne(
             new CreateParticleDTO(
                $body->charge
             )
        );
        StackLogger::sendStatically();

        $res->getBody()->write(
            json_encode($output)
        );

        return $res;
    }
}
