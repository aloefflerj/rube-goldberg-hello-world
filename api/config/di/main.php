<?php

use DI\ContainerBuilder;

require_once(__DIR__ . '/definitions.php');

/** @var ContainerBuilder $builder */
$container = $builder->build();

/** Global Config */
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/database.php');
require_once(__DIR__ . '/messaging.php');

/** Domain Config */
require_once(__DIR__ . '/domain/particles.php');
