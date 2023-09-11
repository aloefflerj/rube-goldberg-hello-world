<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\FetchHydration;
use Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain\Charge;
use Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain\ParticleId;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Particle implements \JsonSerializable, ArrayParseable, FetchHydration
{
    public function __construct(
        private ParticleId $id,
        private Charge $charge
    ) {
    }

    public function getId(): ParticleId
    {
        return $this->id;
    }

    public function getCharge(): Charge
    {
        return $this->charge;
    }

    public function jsonSerialize(): mixed
    {
        $json = new \stdClass();

        $json->id = (string)$this->id;
        $json->charge = (string)$this->charge->id;

        return $json;
    }

    public function toArray(): array
    {
        return [
            'id' => (string)$this->id,
            'charge' => $this->charge->value
        ];
    }

    public static function hydrateByFetch(\stdClass $fetch): self
    {
        StackLogger::sendStatically();
        return new self(
            new ParticleId($fetch->id),
            Charge::tryFrom($fetch->charge)
        );
    }
}
