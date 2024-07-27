<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Repository;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Builder\Query;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlQueryBinder;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use stdClass;

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

    public function fetchCurrentActiveStep(): ?stdClass
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM `steps`
                WHERE `status` = 'ongoing'
            SQL)
        );

        $this->db->execute();
        StackLogger::sendStatically();

        return $this->db->fetchOne();
    }

    public function updateStatus(string $id, string $status): bool
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                UPDATE `steps`
                SET `status` = :status
                WHERE `id` = :id
            SQL)
        );

        $this->db->bindValue(
            (new MysqlQueryBinder(':status'))
                ->bindString($status)
        );
        $this->db->bindValue(
            (new MysqlQueryBinder(':id'))
                ->bindString($id)
        );
        $updated = $this->db->execute();
        StackLogger::sendStatically();

        return $updated;
    }

    public function updateStatusByOrder(int $order, string $status): bool
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                UPDATE `steps`
                SET `status` = :status
                WHERE `order` = :order
            SQL)
        );

        $this->db->bindValue(
            (new MysqlQueryBinder(':status'))
                ->bindString($status)
        );
        $this->db->bindValue(
            (new MysqlQueryBinder(':order'))
                ->bindString($order)
        );
        $updated = $this->db->execute();
        StackLogger::sendStatically();

        return $updated;
    }

    public function setAllStepsAsWaiting(): bool
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                UPDATE `steps`
                SET `status` = 'waiting'
                WHERE `order` != 1
            SQL)
        );

        $updated = $this->db->execute();
        StackLogger::sendStatically();

        return $updated;
    }

    public function setFirstStepAsOngoing(): bool
    {
        StackLogger::sendStatically();
        $this->db->prepare(
            new Query(<<<SQL
                UPDATE `steps`
                SET `status` = 'ongoing'
                WHERE `order` = 1
            SQL)
        );
        
        $updated = $this->db->execute();
        StackLogger::sendStatically();

        return $updated;
    }
}
