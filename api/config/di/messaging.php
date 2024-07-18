<?php

use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Ampq\AmpqDriver;
use DI\Container;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/** @var Container $container */
$container->set('messaging', function (Container $c) {
    $mqConfig = $c->get('config')['rabbitmq'];

    $connection = new AMQPStreamConnection(
        $mqConfig['host'],
        $mqConfig['port'],
        $mqConfig['user'],
        $mqConfig['password']
    );
    $channel = $connection->channel();

    return new AmpqDriver($connection, $channel);
});
