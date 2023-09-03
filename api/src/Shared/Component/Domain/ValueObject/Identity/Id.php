<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Identity;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Uuid;

abstract class Id extends Uuid implements IdValueObject
{
    public function equals(Uuid $other): bool
    {
        return (string)$this === (string)$other;
    }
}
