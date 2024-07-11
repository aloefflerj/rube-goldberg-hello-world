<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;

interface ParticlesMessaging
{
    public function __construct(MessagingDriver $messaging);
    public function send(\stdClass $message): void;
}
