<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain\Speech;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain\Speeches;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts\SpeechRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchedSpeechesByStepDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchSpeechesByStepDTO;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class FetchStepSpeechesUseCase
{
    public function __construct(
        private SpeechRepository $repository,
    ) {
    }

    public function findByStep(FetchSpeechesByStepDTO $dto): FetchedSpeechesByStepDTO
    {
        $speeches = new Speeches();

        StackLogger::sendStatically();
        $speechesIterator = $this->repository->fetchByStepId($dto->stepId, 'order');
        StackLogger::sendStatically();

        foreach ($speechesIterator as $speechFetch) {
            $speech = Speech::hydrateByFetch($speechFetch);
            $speeches->add($speech);
        }
        StackLogger::sendStatically();

        return new FetchedSpeechesByStepDTO($speeches->toArray());
    }
}
