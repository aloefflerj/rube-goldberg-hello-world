<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions;

class RequiredBodyFieldNotGiven extends \InvalidArgumentException
{
    public function __construct(
        string $fieldName,
        string $appendedMessage = '',
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct(
            sprintf(
                'Field [%s] is required on request body. %s',
                $fieldName,
                $appendedMessage
            ),
            $code,
            $previous
        );
    }
}