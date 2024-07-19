<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Messaging;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepMessaging;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Ampq\AmqpDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class StepAmqpMessaging implements StepMessaging
{
    public const QUEUE = 'steps';
    private AmqpDriver $messaging;

    public function __construct(MessagingDriver $messaging)
    {
        $this->messaging = $messaging;
    }

    public function send(\stdClass $message): void
    {
        StackLogger::sendStatically();
        $this->messaging->send($message, self::QUEUE);
    }
}
