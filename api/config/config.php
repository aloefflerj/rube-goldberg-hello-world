<?php

return [
    'database' => [
        'host' => $_ENV['MYSQL_HOST'],
        'dbName' => $_ENV['MYSQL_DB'],
        'user' => $_ENV['MYSQL_USER'],
        'passwd' => $_ENV['MYSQL_PASSWD']
    ],
    'env' => $_ENV['ENV']
];