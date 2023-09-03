<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Uuid;

interface UuidGenerator
{
    public function generate(): Uuid;
}
