<?php

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Adapters\Http\FetchStepSpeechesAction;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts\SpeechRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\FetchStepSpeechesUseCase;
use DI\Container;

/** @var Container $container */
$container->set(FetchStepSpeechesAction::class, function (Container $c) {
    return new FetchStepSpeechesAction(
        new FetchStepSpeechesUseCase(
            $c->get(
                SpeechRepository::class
            )
        )
    );
});
