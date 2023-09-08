<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Builder;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\QueryStatement;

final class Query implements QueryStatement
{
    public function __construct(
        private string $query
    ) {
    }

    public function __toString(): string
    {
        return $this->query;
    }
}
