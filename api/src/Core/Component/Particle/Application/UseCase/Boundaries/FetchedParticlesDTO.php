<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\OutputBoundary;

class FetchedParticlesDTO implements OutputBoundary
{
    public function __construct(
        public readonly array $particles
    ) {
    }
}
