<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts;

interface UuidValidator
{
    /**
     * @throws GivenStringIsNotAValidUuid
     */
    public function isValid(string $uuidString): void;
}
