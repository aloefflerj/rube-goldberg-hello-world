<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;

class PDORepositoryIterator implements RepositoryIterator
{
    public function __construct(protected \PDOStatement $pdoStm)
    {
    }

    public function getIterator(): \Traversable
    {
        return $this->pdoStm->getIterator();
    }
}
