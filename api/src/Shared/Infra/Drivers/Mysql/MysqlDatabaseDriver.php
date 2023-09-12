<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\QueryBinder;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\QueryStatement;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\PDORepositoryIterator;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use stdClass;

final class MysqlDatabaseDriver implements DatabaseDriver
{
    private \PDOStatement $statement;
    
    public function __construct(
        private \PDO $pdo
    ) {
        StackLogger::sendStatically();
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

    public function bindValue(QueryBinder $queryBinder): self
    {
        $this->statement->bindValue(
            $queryBinder->getKey(),
            $queryBinder->getValue(),
            $queryBinder->getFlags()
        );

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
    
    public function fetchOne(): ?stdClass
    {
        return $this->statement->fetch() ?: null;
    }

    public function getIterator(): PDORepositoryIterator
    {
        return new PDORepositoryIterator($this->statement);
    }
}
