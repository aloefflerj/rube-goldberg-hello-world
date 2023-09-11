<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

enum AbstractionLayer: string
{
    case CONTROLLER = 'Controller';
    case MYSQL_REPOSITORY = 'MSQL Repository';
    case USE_CASE = 'Use Case';
    case DOMAIN = 'Domain';

    case UNKNOWN = 'Unkown Layer';
}
