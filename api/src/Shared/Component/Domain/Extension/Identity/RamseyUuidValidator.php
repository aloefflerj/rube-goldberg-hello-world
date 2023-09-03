<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts\UuidValidator;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Exceptions\GivenStringIsNotAValidUuid;
use Ramsey\Uuid\Uuid;

final class RamseyUuidValidator implements UuidValidator
{
    /**
     * @throws GivenStringIsNotAValidUuid
     */
    public function isValid(string $uuidString): void
    {
        if (!Uuid::isValid($uuidString))
            throw new GivenStringIsNotAValidUuid(sprintf(
                "Given string [%s] does not attend to the Uuid requisites for [%s]",
                $uuidString,
                self::class
            ));
    }
}
