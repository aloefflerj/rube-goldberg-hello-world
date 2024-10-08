<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

class StackLoggerSendMessageDTO
{
    public function __construct(
        public readonly string $messageType,
        public readonly string $className,
        public readonly string $functionName,
        public readonly string $abstractionLayer,
        public readonly string $abstractionType,
    ) {
    }
}
