<?php

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Repository;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Builder\Query;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Iterators\Contracts\RepositoryIterator;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlQueryBinder;
use stdClass;

class ParticlesMysqlRepository implements ParticlesRepository
{
    private MysqlDatabaseDriver $db;

    public function __construct(DatabaseDriver $db)
    {
        $this->db = $db;
    }

    public function fetchAll(string $orderBy): RepositoryIterator
    {
        $this->db->prepare(
            new Query(<<<SQL
                SELECT * FROM particles
            SQL)
        );

        $this->db->execute();

        return $this->db->getIterator();
    }

    public function findById(string $id): ?stdClass
    {
        $this->db->prepare(
            new Query(<<<SQL
                SELECT *
                FROM particles
                WHERE id = :id
            SQL)
        );

        $this->db->bindValue(
            (new MysqlQueryBinder(':id'))
                ->bindString($id)
        );
        $this->db->execute();

        return $this->db->fetchOne();
    }
}