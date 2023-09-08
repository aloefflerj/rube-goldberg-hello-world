<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts;

interface QueryStatement
{
    // public function getValues(): array;
    public function __toString(): string;
}
