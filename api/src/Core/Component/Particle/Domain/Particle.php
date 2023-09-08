<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\FetchHydration;
use Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain\ParticleId;

class Particle implements \JsonSerializable, ArrayParseable, FetchHydration
{
    public function __construct(
        private ParticleId $id
    ) {
    }

    public function jsonSerialize(): mixed
    {
        $json = new \stdClass();

        $json->id = (string)$this->id;

        return $json;
    }

    public function toArray(): array
    {
        return [
            'id' => (string)$this->id
        ];
    }

    public static function hydrateByFetch(\stdClass $fetch): self
    {
        return new self(
            new ParticleId($fetch->id)
        );
    }
}
