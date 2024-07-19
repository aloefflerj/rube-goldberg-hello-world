<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase;

use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\Contracts\SpeechRepository;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain\Speech;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Domain\Speeches;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\Boundaries\FetchedSpeechesDTO;
use Aloefflerj\UniverseOriginApi\Core\Component\Speech\Application\UseCase\Boundaries\FetchSpeechesDTO;
use Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger\StackLogger;

final class FetchSpeechesUseCase
{
    public function __construct(private SpeechRepository $repository)
    {
    }

    public function fetchAll(FetchSpeechesDTO $dto): FetchedSpeechesDTO
    {
        $speeches = new Speeches();

        StackLogger::sendStatically();
        $speechesIterator = $this->repository->fetchAll($dto->orderBy);
        StackLogger::sendStatically();

        foreach ($speechesIterator as $speechFetch) {
            $speech = Speech::hydrateByFetch($speechFetch);
            $speeches->add($speech);
        }
        StackLogger::sendStatically();

        return new FetchedSpeechesDTO($speeches->toArray());
    }
}
