<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\Boundaries;

use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\OutputBoundary;

class FetchedSpeechesDTO implements OutputBoundary
{
    public function __construct(
        public readonly array $speeches
    ) {
    }
}
