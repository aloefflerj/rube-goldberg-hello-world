<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\Exceptions;

use Ds\Collection;

class InvalidCollectionItem extends \InvalidArgumentException
{
    public function __construct(
        mixed $item,
        Collection $collection,
        string $appendMsg = '',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $itemMsg = var_export($item, true);
        parent::__construct(
            sprintf(
                "[%s] is not a valid item for [%s] collection",
                $itemMsg,
                get_class($collection)
            ) . $appendMsg,
            $code
        );
    }
}
