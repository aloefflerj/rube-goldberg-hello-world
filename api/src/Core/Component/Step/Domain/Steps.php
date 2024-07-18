<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\AbstractCollection;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Steps extends AbstractCollection implements ArrayParseable
{
    public function __construct(Step ...$steps)
    {
        StackLogger::sendStatically();
        foreach ($steps as $step) {
            $this->items[] = $step;
        }
    }

    public function add(Step $step): void
    {
        $this->items[] = $step;
    }

    public function toArray(): array
    {
        return array_map(
            fn (Step $step) => $step->toArray(),
            $this->items
        );
    }
}
