<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\CreateParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FoundParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particle;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotCreatedDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotFoundDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain\ParticleId;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class CreateParticleUseCase
{
    public function __construct(private ParticlesRepository $repository)
    {
    }

    public function createOne(CreateParticleDTO $dto): FoundParticleDTO|NotCreatedDTO
    {
        StackLogger::sendStatically();
        $created = $this->repository->createOne(
            (string)ParticleId::new(),
            $dto->charge
        );
        StackLogger::sendStatically();

        if (!$created) return new NotCreatedDTO();

        StackLogger::sendStatically();
        $found = $this->repository->findById($created->id);
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
