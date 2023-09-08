<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql;

final class MysqlConnectionDsn
{
    public readonly string $host;
    public readonly string $dbName;
    public readonly string $user;
    public readonly string $passwd;

    public function __construct(
        array $dsnConfig
    ) {
        $this->host = $dsnConfig['host'];
        $this->dbName = $dsnConfig['dbName'];
        $this->user = $dsnConfig['user'];
        $this->passwd = $dsnConfig['passwd'];
    }
}
