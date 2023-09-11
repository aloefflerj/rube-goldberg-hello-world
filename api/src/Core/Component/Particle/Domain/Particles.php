<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\AbstractCollection;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLoggerSendMessageDAO;

class Particles extends AbstractCollection
{
    public function __construct(Particle ...$particles)
    {
        $stackLogger = new StackLogger();
        $stackLogger->send(
            new StackLoggerSendMessageDAO(
                'StackLoggger',
                (new \ReflectionClass($this))->getShortName(),
                '__construct',
                'Domain'
            )
        );
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
