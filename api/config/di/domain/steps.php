<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepsUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\FetchStepsAction;
use DI\Container;

/** @var Container $container */
$container->set(FetchStepsAction::class, function (Container $c) {
    return new FetchStepsAction(
        new FetchStepsUseCase(
            $c->get(
                StepRepository::class
            )
        )
    );
});
