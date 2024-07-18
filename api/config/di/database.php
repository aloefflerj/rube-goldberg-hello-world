<?php

use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnection;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnectionDsn;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use DI\Container;

/** @var Container $container */
$container->set('database', function (Container $c) {
    $dbConfig = $c->get('config')['database'];

    $dsn = new MysqlConnectionDsn($dbConfig);
    $conn = new MysqlConnection($dsn);
    $pdo = $conn->getPdo();

    return new MysqlDatabaseDriver($pdo);
});