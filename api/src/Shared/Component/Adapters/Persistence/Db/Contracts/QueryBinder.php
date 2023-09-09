<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts;

interface QueryBinder
{
    public function __construct(string $key);
    public function bindValue(mixed $value, int $flags = \PDO::PARAM_STR): self;
    public function bindString(string $value): self;
    public function bindInt(int $value): self;
    public function bindBool(bool $value): self;

    public function getKey(): string;
    public function getValue(): mixed;
    public function getFlags(): int;
}
