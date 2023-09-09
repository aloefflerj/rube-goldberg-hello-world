<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Persistence\Db\Contracts\QueryBinder;
use Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Mysql\Exceptions\BindMustHaveAValueSetted;

final class MysqlQueryBinder implements QueryBinder
{
    private mixed $value;
    private int $flags = \PDO::PARAM_STR;

    public function __construct(private string $key)
    {
    }

    public function bindValue(mixed $value, int $flags = \PDO::PARAM_STR): QueryBinder
    {
        $this->value = $value;
        $this->flags = $flags;
        return $this;
    }

    public function bindString(string $value): QueryBinder
    {
        $this->value = $value;
        $this->flags = \PDO::PARAM_STR;
        return $this;
    }

    public function bindInt(int $value): QueryBinder
    {
        $this->value = $value;
        $this->flags = \PDO::PARAM_INT;
        return $this;
    }

    public function bindBool(bool $value): QueryBinder
    {
        $this->value = $value;
        $this->flags = \PDO::PARAM_BOOL;
        return $this;
    }
    
    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): mixed
    {
        if (!isset($this->value))
            throw new BindMustHaveAValueSetted(
                'Binder value must be setted with some binder method. See: ' .
                    QueryBinder::class
            );

        return $this->value;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }
}
