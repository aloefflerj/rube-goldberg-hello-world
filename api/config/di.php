<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Application\Contracts\ParticlesRepository\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Repository\ParticlesMysqlRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\ParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnection;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlConnectionDsn;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\MysqlDatabaseDriver;
use DI\Container;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->addDefinitions([
    DatabaseDriver::class => DI\get('database'),
    ParticlesRepository::class => DI\autowire(ParticlesMysqlRepository::class),
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

$container->set(FetchParticlesAction::class, function (Container $c) {
    return new FetchParticlesAction(
        new ParticlesUseCase(
            $c->get(
                ParticlesRepository::class
            )
        )
    );
});

$container->set(FindParticleAction::class, function (Container $c) {
    return new FindParticleAction(
        new ParticlesUseCase(
            $c->get(
                ParticlesRepository::class
            )
        )
    );
});

$container->set(CreateParticleAction::class, function (Container $c) {
    return new CreateParticleAction(
        new ParticlesUseCase(
            $c->get(
                ParticlesRepository::class
            )
        )
    );
});
