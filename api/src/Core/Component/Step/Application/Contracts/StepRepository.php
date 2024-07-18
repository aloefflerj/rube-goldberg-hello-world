<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;

interface StepRepository
{
    public function __construct(DatabaseDriver $db);
    public function fetchAll(string $orderBy): RepositoryIterator;
    public function findById(string $id): ?\stdClass;
}
