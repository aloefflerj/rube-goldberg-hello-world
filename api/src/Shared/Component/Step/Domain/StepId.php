<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Contracts\ValueObject;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Identity\Id;

class StepId extends Id implements ValueObject, \Stringable
{
}
