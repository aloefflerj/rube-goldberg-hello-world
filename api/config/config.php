<?php

return [
    'database' => [
        'host' => $_ENV['MYSQL_HOST'],
        'dbName' => $_ENV['MYSQL_DB'],
        'user' => $_ENV['MYSQL_USER'],
        'passwd' => $_ENV['MYSQL_PASSWD']
    ],
    'env' => $_ENV['ENV'],
    'rabbitmq' => [
        'host' => $_ENV['MQ_HOST'],
        'port' => $_ENV['MQ_PORT'],
        'user' => $_ENV['MQ_USER'],
        'password' => $_ENV['MQ_PASSWORD']
    ],
];
