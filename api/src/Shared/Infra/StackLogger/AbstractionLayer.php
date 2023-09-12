<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

enum AbstractionLayer: string
{
    case WEB_FRAMEWORK = 'Web Framework';
    case WEB_ADAPTER = 'Web Adapter';
    
    case MYSQL_DRIVER = 'MSQL Driver';
    case MYSQL_ADAPTER = 'MSQL Adapter';

    case USE_CASE = 'Use Case';
    case DOMAIN = 'Domain';

    case UNKNOWN = 'Unkown Layer';
}
