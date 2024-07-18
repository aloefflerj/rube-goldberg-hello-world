<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\InputBoundary;

class FetchSpeechesByStepDTO implements InputBoundary
{
    public function __construct(
        public readonly string $stepId
    ) {
    }
}
