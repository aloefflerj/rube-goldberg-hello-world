<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Speech\Domain;

enum Speed: string
{
    case PAUSE = 'pause';
    case SLOW = 'slow';
    case NORMAL = 'normal';
    case FAST = 'fast';
}
