<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Entity\Contracts;

interface FetchHydration
{
    public static function hydrateByFetch(\stdClass $fetch): self;
}
