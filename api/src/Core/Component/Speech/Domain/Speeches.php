<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain;

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain\Speech;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\AbstractCollection;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Speeches extends AbstractCollection implements ArrayParseable
{
    public function __construct(Speech ...$speeches)
    {
        StackLogger::sendStatically();
        foreach ($speeches as $speech) {
            $this->items[] = $speech;
        }
    }

    public function add(Speech $speech): void
    {
        $this->items[] = $speech;
    }

    public function toArray(): array
    {
        return array_map(
            fn (Speech $speech) => $speech->toArray(),
            $this->items
        );
    }
}
