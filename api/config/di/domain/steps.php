<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepsUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\FetchStepsAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\NextStepAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\ResetStepsAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\NextStepUseCase;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\ResetStepsUseCase;
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

$container->set(NextStepAction::class, function (Container $c) {
    return new NextStepAction(
        new NextStepUseCase(
            $c->get(
                StepRepository::class
            ),
            $c->get(
                StepMessaging::class
            )
        )
    );
});

$container->set(ResetStepsAction::class, function (Container $c) {
    return new ResetStepsAction(
        new ResetStepsUseCase(
            $c->get(
                StepRepository::class
            ),
            $c->get(
                StepMessaging::class
            )
        )
    );
});
