<?php

use DI\Container;

/** @var Container $container */
$container->set('config', fn () => require dirname(__DIR__, 1) . '/config.php');
$container->set('env', fn (Container $c) => $c->get('config')['env']);
$container->set('development', fn (Container $c) => $c->get('env') === 'dev');
