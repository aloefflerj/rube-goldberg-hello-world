<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Repository;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Builder\Query;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlQueryBinder;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class StepsMysqlRepository implements StepRepository
{
    private MysqlDatabaseDriver $db;

    public function __construct(DatabaseDriver $db)
    {
        $this->db = $db;
    }

    public function fetchAll(string $orderBy): RepositoryIterator
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM `steps`
                ORDER BY `order`
            SQL)
        );

        $this->db->execute();
        StackLogger::sendStatically();

        return $this->db->getIterator();
    }

    public function findById(string $id): ?\stdClass
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM `steps`
                WHERE id = :id
            SQL)
        );

        $this->db->bindValue(
            (new MysqlQueryBinder(':id'))
                ->bindString($id)
        );

        $this->db->execute();
        StackLogger::sendStatically();

        return $this->db->fetchOne();
    }
}
