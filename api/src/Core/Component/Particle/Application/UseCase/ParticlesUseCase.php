<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\CreateParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchedParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FindParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FoundParticleDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particle;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particles;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotCreatedDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Boundaries\NotFoundDTO;
use Aloefflerj\UniverseOriginApi\Shared\Component\Particle\Domain\ParticleId;

final class ParticlesUseCase
{
    public function __construct(private ParticlesRepository $repository)
    {
    }

    public function fetchAll(FetchParticlesDTO $dto): FetchedParticlesDTO
    {
        $particles = new Particles();

        $particlesIterator = $this->repository->fetchAll($dto->orderBy);
        foreach ($particlesIterator as $particleFetch) {
            $particle = Particle::hydrateByFetch($particleFetch);
            $particles->add($particle);
        }

        return new FetchedParticlesDTO($particles->toArray());
    }

    public function find(FindParticleDTO $dto): FoundParticleDTO|NotFoundDTO
    {
        $found = $this->repository->findById($dto->id);
        if (!$found) return new NotFoundDTO();


        $particle = Particle::hydrateByFetch(
            $found
        );

        return new FoundParticleDTO(
            (string)$particle->getId(),
            $particle->getCharge()->value
        );
    }

    public function createOne(CreateParticleDTO $dto): FoundParticleDTO|NotCreatedDTO
    {
        $created = $this->repository->createOne(
            (string)ParticleId::new(),
            $dto->charge
        );

        if (!$created) return new NotCreatedDTO();

        $found = $this->repository->findById($created->id);
        if (!$found) return new NotFoundDTO();

        $particle = Particle::hydrateByFetch(
            $found
        );

        return new FoundParticleDTO(
            (string)$particle->getId(),
            $particle->getCharge()->value
        );
    }
}
