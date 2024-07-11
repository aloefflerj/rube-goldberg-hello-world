<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Messaging;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesMessaging;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Ampq\AmpqDriver;

class ParticlesAmqpMessaging implements ParticlesMessaging
{
    public const QUEUE = 'newEntity';
    private AmpqDriver $messaging;

    public function __construct(MessagingDriver $messaging)
    {
        $this->messaging = $messaging;
    }

    public function send(\stdClass $message): void
    {
        $this->messaging->send($message, self::QUEUE);
    }
}
