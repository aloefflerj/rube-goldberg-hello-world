<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts\UuidGenerator;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Identity\Contracts\UuidValidator;

class Uuid implements \Stringable
{
    public function __construct(
        protected string $uuidString,
        private UuidValidator $validator = new RamseyUuidValidator()
    ) {
        $this->ensureIsValid($uuidString);
    }

    private function ensureIsValid(string $uuidString): void
    {
        $this->validator->isValid($uuidString);
    }

    public function __toString(): string
    {
        return $this->uuidString;
    }

    public static function generate(
        UuidGenerator $uuidGenerator = new RamseyUuidGenerator()
    ): static {
        return new static((string)$uuidGenerator->generate());
    }
}
