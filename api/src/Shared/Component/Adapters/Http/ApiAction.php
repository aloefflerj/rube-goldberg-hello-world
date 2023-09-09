<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Http\Exceptions\RequiredBodyFieldNotGiven;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpException;

abstract class ApiAction
{
    abstract protected function dispatch(
        ServerRequestInterface $req,
        ResponseInterface $res,
        array $args
    ): ResponseInterface;

    public function __invoke(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res = $this->dispatch($req, $res, $args);

        if (!empty($res->getHeaders())) return $res;

        return $res->withHeader('Content-Type', 'application/json');
    }

    /**
     * @throws RequiredBodyFieldNotGiven
     */
    public function requiredBodyField(?\stdClass $body, string $fieldName, string $appendExceptionMessage = ''): void
    {
        if (is_null($body) || !isset($body->$fieldName))
            throw new RequiredBodyFieldNotGiven($fieldName);
    }
}
