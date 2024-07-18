<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\CreateParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FetchParticlesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Adapters\Http\FindParticleAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\CreateParticleUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\FetchParticlesUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\FindParticlesUseCase;
use DI\Container;

/** @var Container $container */
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
