<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Adapters\Repository;

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts\SpeechRepository;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Builder\Query;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlQueryBinder;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

class SpeechMysqlRepository implements SpeechRepository
{
    private MysqlDatabaseDriver $db;

    public function __construct(DatabaseDriver $db)
    {
        $this->db = $db;
    }

    public function fetchByStepId(string $stepId, string $orderBy): RepositoryIterator
    {
        StackLogger::sendStatically();
        $orderBy = filter_var($orderBy);

        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM `speeches`
                WHERE step_id = :stepId
                ORDER BY `{$orderBy}` ASC
            SQL)
        );

        $this->db->bindValue(
            (new MysqlQueryBinder(':stepId'))
                ->bindString($stepId)
        );

        $this->db->execute();
        StackLogger::sendStatically();

        return $this->db->getIterator();
    }

    public function fetchAll(string $orderBy): RepositoryIterator
    {
        StackLogger::sendStatically();
        $orderBy = filter_var($orderBy);

        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM `speeches`
                ORDER BY `{$orderBy}`
            SQL)
        );

        $this->db->execute();
        StackLogger::sendStatically();

        return $this->db->getIterator();
    }
}
