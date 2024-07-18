<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\OutputBoundary;

class FetchedStepsDTO implements OutputBoundary
{
    public function __construct(
        public readonly array $steps
    ) {
    }
}
