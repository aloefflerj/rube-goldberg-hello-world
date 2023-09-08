<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\QueryStatement;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\PDORepositoryIterator;

final class MysqlDatabaseDriver implements DatabaseDriver
{
    private \PDOStatement $statement;
    
    public function __construct(
        private \PDO $pdo
    ) {
    }
    
    public function pdo(): \PDO
    {
        return $this->pdo;
    }

    public function close(): void
    {
        unset($this->pdo);
    }

    public function prepare(QueryStatement $query, array $options = []): self
    {
        $this->statement = $this->pdo->prepare((string)$query, $options);
        return $this;
    }

    public function bindValue(string $key, string $value, int $flags = \PDO::PARAM_STR): self
    {
        $this->statement->bindValue($key, $value, $flags);
        return $this;
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function lastInsertedId(): int
    {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }
    
    public function commit(): bool
    {
        return $this->pdo->commit();
    }
    
    public function rollback(): void
    {
        $this->pdo->rollback();
    }
    

    public function getIterator(): PDORepositoryIterator
    {
        return new PDORepositoryIterator($this->statement);
    }
}
