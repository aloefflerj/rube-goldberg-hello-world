<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Identity;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Uuid;

interface IdValueObject
{
    public function equals(Uuid $other): bool;
}