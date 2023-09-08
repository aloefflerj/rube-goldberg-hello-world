<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;

interface DatabaseDriver
{
    public function close(): void;
    public function prepare(QueryStatement $statement, array $options = []): self;
    public function execute(): bool;
    // public function executeSql(string $sql, array $values = []): DatabaseDriver;
    public function lastInsertedId(): int;
    // public function fetchOne(): ?array;
    public function getIterator(): RepositoryIterator;
    // public function fetchAll(): array;
    public function beginTransaction(): bool;
    public function commit(): bool;
    public function rollback(): void;
}
