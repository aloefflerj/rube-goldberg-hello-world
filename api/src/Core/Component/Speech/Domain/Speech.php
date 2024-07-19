<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\ArrayParseable;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts\FetchHydration;
use Aloefflerj\UniverseOriginApi\Shared\Component\Speech\Domain\SpeechId;
use Aloefflerj\UniverseOriginApi\Shared\Component\Speech\Domain\Speed;
use Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain\StepId;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class Speech implements \JsonSerializable, ArrayParseable, FetchHydration
{
    public function __construct(
        private SpeechId $id,
        private StepId $stepId,
        private int $order,
        private string $content,
        private Speed $speed,
        private bool $highlight,
    ) {
    }

    public function getId(): SpeechId
    {
        return $this->id;
    }

    public function getStepId(): StepId
    {
        return $this->stepId;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSpeed(): Speed
    {
        return $this->speed;
    }

    public function isHighlight(): bool
    {
        return $this->highlight;
    }

    public function jsonSerialize(): mixed
    {
        $json = new \stdClass();

        $json->id = (string)$this->getId();
        $json->stepId = (string)$this->getStepId();
        $json->order = $this->getOrder();
        $json->content = $this->getContent();
        $json->speed = $this->getSpeed()->value;
        $json->highlight = $this->isHighlight();

        return $json;
    }

    public function toArray(): array
    {
        return [
            'id' => (string)$this->getId(),
            'stepId' => (string)$this->getStepId(),
            'order' => $this->getOrder(),
            'content' => $this->getContent(),
            'speed' => $this->getSpeed()->value,
            'highlight' => $this->isHighlight(),
        ];
    }

    public static function hydrateByFetch(\stdClass $fetch): self
    {
        StackLogger::sendStatically();
        return new self(
            new SpeechId($fetch->id),
            new StepId($fetch->step_id),
            $fetch->order,
            $fetch->content,
            Speed::from($fetch->speed),
            (bool)$fetch->highlight
        );
    }
}
