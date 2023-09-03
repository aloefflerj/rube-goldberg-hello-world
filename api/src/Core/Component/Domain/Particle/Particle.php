<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Domain\Particle;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Particle\ParticleId;

class Particle
{
    public function __construct(
        private ParticleId $id
    ) {
    }
}
