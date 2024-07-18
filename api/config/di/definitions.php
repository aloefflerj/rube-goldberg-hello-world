<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Messaging\ParticlesAmqpMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Repository\ParticlesMysqlRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Adapters\Repository\SpeechMysqlRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Repository\StepsMysqlRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts\SpeechRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;
use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\DatabaseDriver;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->addDefinitions([
    DatabaseDriver::class => DI\get('database'),
    MessagingDriver::class => DI\get('messaging'),

    ParticlesRepository::class => DI\autowire(ParticlesMysqlRepository::class),
    ParticlesMessaging::class => DI\autowire(ParticlesAmqpMessaging::class),

    StepRepository::class => DI\autowire(StepsMysqlRepository::class),

    SpeechRepository::class => DI\autowire(SpeechMysqlRepository::class),
]);
