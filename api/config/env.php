<?php

use Dotenv\Dotenv;
$dotEnv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotEnv->safeLoad();
