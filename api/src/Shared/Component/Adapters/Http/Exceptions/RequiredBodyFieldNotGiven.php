<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions\Contracts\HttpRouteException;
use Lukasoppermann\Httpstatus\Httpstatus;

class RequiredBodyFieldNotGiven extends \InvalidArgumentException implements HttpRouteException
{
    public function __construct(
        string $fieldName,
        string $appendedMessage = '',
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        // REFACTOR: ADD TRAIT
        $httpStatus = new Httpstatus();
        $this->code = 422;

        $statusCodeMessage = $httpStatus->getReasonPhrase(
            $this->code
        );

        parent::__construct(
            sprintf(
                '%s. Field [%s] is required on request body. %s',
                $statusCodeMessage,
                $fieldName,
                $appendedMessage
            ),
            $code,
            $previous
        );
    }
}