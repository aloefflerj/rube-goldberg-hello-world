<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

enum AbstractionType: string
{
    case WEB_FRAMEWORK = 'webFramework';
    case WEB_ADAPTER = 'webAdapter';
    
    case MYSQL_DRIVER = 'mysqlDriver';
    case MYSQL_ADAPTER = 'mysqlAdapter';
    
    case USE_CASE = 'useCase';
    case DOMAIN = 'domain';

    case UNKNOWN = 'unkown';
}
