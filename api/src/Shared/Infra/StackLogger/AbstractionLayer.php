<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

enum AbstractionLayer: string
{
    case FRAMEWORK_DRIVER = 'frameworkDriver';
    case ADAPTER = 'adapter';
    case USE_CASE = 'useCase';
    case DOMAIN = 'domain';
    case UNKNOWN = 'unkown';
}
