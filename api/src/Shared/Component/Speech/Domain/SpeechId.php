<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Speech\Domain;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Contracts\ValueObject;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\ValueObject\Identity\Id;

class SpeechId extends Id implements ValueObject, \Stringable
{
}
