<?php

use Dotenv\Dotenv;

$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();
