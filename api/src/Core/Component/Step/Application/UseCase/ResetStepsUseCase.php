<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepMessaging;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\ResetStepResponseDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain\Step;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotFoundDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotUpdatedDTO;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class ResetStepsUseCase
{
    public function __construct(
        private StepRepository $repository,
        private StepMessaging $messaging,
    ) {
    }

    public function reset(): ResetStepResponseDTO|NotUpdatedDTO|NotFoundDTO
    {
        if (!$this->setAllStepsAsWaiting()) {
            return new NotUpdatedDTO();
        }

        if (!$this->setFirstStepAsOngoing()) {
            return new NotUpdatedDTO();
        }

        if (!$currentStep = $this->fetchCurrentStep()) {
            return new NotFoundDTO();
        }

        $this->sendCurrentStepMessage($currentStep);

        return new ResetStepResponseDTO(
            $currentStep->toArray()
        );
    }

    private function fetchCurrentStep(): ?Step
    {
        StackLogger::sendStatically();
        $fetchedCurrentStep = $this->repository->fetchCurrentActiveStep();
        StackLogger::sendStatically();

        return $fetchedCurrentStep ? Step::hydrateByFetch($fetchedCurrentStep) : null;
    }

    private function setAllStepsAsWaiting(): bool
    {
        StackLogger::sendStatically();
        $updated = $this->repository->setAllStepsAsWaiting();
        StackLogger::sendStatically();

        return $updated;
    }

    private function setFirstStepAsOngoing(): bool
    {
        StackLogger::sendStatically();
        $updated = $this->repository->setFirstStepAsOngoing();
        StackLogger::sendStatically();

        return $updated;
    }

    private function sendCurrentStepMessage(Step $currentStep): void
    {
        StackLogger::sendStatically();
        $this->messaging->send($currentStep->jsonSerialize());
        StackLogger::sendStatically();
    }
}
