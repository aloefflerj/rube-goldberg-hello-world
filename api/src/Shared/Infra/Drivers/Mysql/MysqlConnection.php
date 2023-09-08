<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql;

final class MysqlConnection
{
    private \PDO $pdo;
    public function __construct(
        private MysqlConnectionDsn $dsn
    ) {
    }

    public function getDsn(): MysqlConnectionDsn
    {
        return $this->dsn;
    }

    public function applyConfig(): \PDO
    {
        $dsn = $this->getDsn();

        $this->pdo = new \PDO(
            "mysql:host={$dsn->host};dbname={$dsn->dbName}",
            $dsn->user,
            $dsn->passwd,
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );

        return $this->pdo;
    }

    public function getPdo(): \PDO
    {
        if (!isset($this->pdo))
            $this->pdo = $this->applyConfig();

        return $this->pdo;
    }
}
