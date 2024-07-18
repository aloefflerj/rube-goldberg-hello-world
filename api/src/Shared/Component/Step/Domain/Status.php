<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Step\Domain;

enum Status: string
{
    case WAITING = 'waiting';
    case ONGOING = 'ongoing';
    case FINISHED = 'finished';
}
