<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FindParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FoundParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particle;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotFoundDTO;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class FindParticlesUseCase
{
    public function __construct(private ParticlesRepository $repository)
    {
    }

    public function find(FindParticleDTO $dto): FoundParticleDTO|NotFoundDTO
    {
        StackLogger::sendStatically();
        $found = $this->repository->findById($dto->id);
        StackLogger::sendStatically();

        if (!$found) return new NotFoundDTO();

        $particle = Particle::hydrateByFetch(
            $found
        );
        StackLogger::sendStatically();

        return new FoundParticleDTO(
            (string)$particle->getId(),
            $particle->getCharge()->value
        );
    }
}
