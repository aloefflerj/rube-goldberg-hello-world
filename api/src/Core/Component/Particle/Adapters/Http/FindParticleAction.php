<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\ApiAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FindParticleAction extends ApiAction
{
    public function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface {
        $res->getBody()->write(
            json_encode([
                'key' => 'value'
            ])
        );

        return $res;
    }
}
