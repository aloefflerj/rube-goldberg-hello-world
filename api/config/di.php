<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Messaging\ParticlesAmqpMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Repository\ParticlesMysqlRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\CreateParticleUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\FetchParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\FindParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Ampq\AmpqDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnection;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnectionDsn;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use DI\Container;
use DI\ContainerBuilder;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$builder = new ContainerBuilder();

$builder->addDefinitions([
    DatabaseDriver::class => DI\get('database'),
    MessagingDriver::class => DI\get('messaging'),
    ParticlesRepository::class => DI\autowire(ParticlesMysqlRepository::class),
    ParticlesMessaging::class => DI\autowire(ParticlesAmqpMessaging::class),
]);

$container = $builder->build();

$container->set('config', fn () => require __DIR__ . '/config.php');
$container->set('env', fn (Container $c) => $c->get('config')['env']);
$container->set('development', fn (Container $c) => $c->get('env') === 'dev');

$container->set('database', function (Container $c) {
    $dbConfig = $c->get('config')['database'];

    $dsn = new MysqlConnectionDsn($dbConfig);
    $conn = new MysqlConnection($dsn);
    $pdo = $conn->getPdo();

    return new MysqlDatabaseDriver($pdo);
});

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

$container->set(FetchParticlesAction::class, function (Container $c) {
    return new FetchParticlesAction(
        new FetchParticlesUseCase(
            $c->get(
                ParticlesRepository::class
            )
        )
    );
});

$container->set(FindParticleAction::class, function (Container $c) {
    return new FindParticleAction(
        new FindParticlesUseCase(
            $c->get(
                ParticlesRepository::class
            )
        )
    );
});

$container->set(CreateParticleAction::class, function (Container $c) {
    return new CreateParticleAction(
        new CreateParticleUseCase(
            $c->get(
                ParticlesRepository::class
            ),
            $c->get(
                ParticlesMessaging::class
            )
        )
    );
});
