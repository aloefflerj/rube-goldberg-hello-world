<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\InputBoundary;

class FetchSpeechesDTO implements InputBoundary
{
    public function __construct(
        public readonly string $orderBy
    ) {
    }
}