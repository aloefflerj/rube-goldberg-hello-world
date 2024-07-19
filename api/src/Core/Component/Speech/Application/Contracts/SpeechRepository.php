<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;

interface SpeechRepository
{
    public function __construct(DatabaseDriver $db);
    public function fetchAll(string $orderBy): RepositoryIterator;
    public function fetchByStepId(string $stepId, string $orderBy): RepositoryIterator;
}
