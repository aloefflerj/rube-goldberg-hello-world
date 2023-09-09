<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\CreateParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\ParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateParticleAction extends ApiAction
{
    public function __construct(private ParticlesUseCase $useCase)
    {
    }

    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        $body = json_decode($req->getBody()->getContents());
        
        $this->requiredBodyField($body, 'charge');

        $output = $this->useCase->createOne(
             new CreateParticleDTO(
                $body->charge
             )
        );

        $res->getBody()->write(
            json_encode($output)
        );

        return $res;
    }
}
