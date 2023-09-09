<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Contracts\ValueObject;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Identity\Id;

class ParticleId extends Id implements ValueObject, \Stringable
{
}
