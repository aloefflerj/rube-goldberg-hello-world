<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\FetchHydration;
use Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain\StepId;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Step implements \JsonSerializable, ArrayParseable, FetchHydration
{
    public function __construct(
        private StepId $id,
        private string $title,
        private int $order
    ) {
    }

    public function getId(): StepId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function jsonSerialize(): mixed
    {
        $json = new \stdClass();

        $json->id = $this->getId();
        $json->title = $this->getTitle();
        $json->order = $this->getOrder();

        return $json;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'order' => $this->getOrder()
        ];
    }

    public static function hydrateByFetch(\stdClass $fetch): self
    {
        StackLogger::sendStatically();
        return new self(
            new StepId($fetch->id),
            $fetch->title,
            $fetch->order
        );
    }
}
