<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts\UuidGenerator;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): Uuid
    {
        return new Uuid(
            RamseyUuid::uuid4()->toString()
        );
    }
}
