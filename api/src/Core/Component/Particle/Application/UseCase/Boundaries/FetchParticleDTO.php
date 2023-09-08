<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\InputBoundary;

class FetchParticlesDTO implements InputBoundary
{
    public function __construct(
        public readonly string $id
    ) {
    }
}
