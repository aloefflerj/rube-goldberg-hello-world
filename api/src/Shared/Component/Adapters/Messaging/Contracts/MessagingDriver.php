<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts;

interface MessagingDriver
{
    public function send(\stdClass $message, string $queue): void;
}
