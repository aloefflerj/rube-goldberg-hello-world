<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchedParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particle;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particles;

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
}
