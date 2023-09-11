<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\Contracts\ParticlesRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchedParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Application\UseCase\Boundaries\FetchParticlesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particle;
use Aloefflerj\UniverseOriginApi\Core\Component\Particle\Domain\Particles;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLoggerSendMessageDAO;

final class FetchParticlesUseCase
{
    public function __construct(private ParticlesRepository $repository)
    {
    }

    public function fetchAll(FetchParticlesDTO $dto): FetchedParticlesDTO
    {
        StackLogger::sendStatically();
        $particles = new Particles();
        StackLogger::sendStatically();

        $particlesIterator = $this->repository->fetchAll($dto->orderBy);
        StackLogger::sendStatically();

        foreach ($particlesIterator as $particleFetch) {
            $particle = Particle::hydrateByFetch($particleFetch);
            $particles->add($particle);
        }
        StackLogger::sendStatically();

        return new FetchedParticlesDTO($particles->toArray());
    }
}
