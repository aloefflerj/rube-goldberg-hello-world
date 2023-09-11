<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\AbstractCollection;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Particles extends AbstractCollection
{
    public function __construct(Particle ...$particles)
    {
        StackLogger::sendStatically();
        foreach ($particles as $particle) {
            $this->items[] = $particle;
        }
    }

    public function add(Particle $particle): void
    {
        $this->items[] = $particle;
    }

    public function toArray(): array
    {
        return array_map(
            fn (Particle $particle) => $particle->toArray(),
            $this->items
        );
    }
}
