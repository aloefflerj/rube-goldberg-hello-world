<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;

interface StepMessaging
{
    public function __construct(MessagingDriver $messaging);
    public function send(\stdClass $message): void;
}
