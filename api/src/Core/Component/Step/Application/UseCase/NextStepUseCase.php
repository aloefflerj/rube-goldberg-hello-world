<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\Contracts\StepRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Application\UseCase\Boundaries\NextStepResponseDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Step\Domain\Step;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotFoundDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotUpdatedDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain\Status;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class NextStepUseCase
{
    public function __construct(private StepRepository $repository)
    {
    }

    public function next(): NextStepResponseDTO|NotUpdatedDTO|NotFoundDTO
    {
        if (!$currentStep = $this->fetchCurrentStep())
            return new NotFoundDTO();

        if (!$this->finishCurrentStep($currentStep))
            return new NotUpdatedDTO();

        if (!$this->setNextStepAsOnGoing($currentStep))
            return new NotUpdatedDTO();

        if (!$currentStep = $this->fetchCurrentStep())
            return new NotFoundDTO();
    
        return new NextStepResponseDTO(
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

    private function finishCurrentStep(Step $currentStep): bool
    {
        StackLogger::sendStatically();
        $updated = $this->repository->updateStatus(
            (string)$currentStep->getId(),
            Status::FINISHED->value
        );
        StackLogger::sendStatically();
        
        return $updated;
    }

    private function setNextStepAsOnGoing(Step $currentStep): bool
    {
        StackLogger::sendStatically();
        $updated = $this->repository->updateStatusByOrder(
            $currentStep->getNextStepOrder(),
            Status::ONGOING->value
        );
        StackLogger::sendStatically();

        return $updated;
    }
}
