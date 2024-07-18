<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchedStepsDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\FetchStepsDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain\Step;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain\Steps;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class FetchStepsUseCase
{
    public function __construct(private StepRepository $repository)
    {
    }

    public function fetchAll(FetchStepsDTO $dto): FetchedStepsDTO
    {
        $steps = new Steps();

        $stepsIterator = $this->repository->fetchAll($dto->orderBy);
        StackLogger::sendStatically();

        foreach ($stepsIterator as $stepFetch) {
            $step = Step::hydrateByFetch($stepFetch);
            $steps->add($step);
        }
        StackLogger::sendStatically();

        return new FetchedStepsDTO($steps->toArray());
    }
}
