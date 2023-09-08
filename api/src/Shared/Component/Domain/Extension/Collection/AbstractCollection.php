<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection;

use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\Exception\ItemsMustBeSerializableToJson;
use Aloefflerj\UniverseOriginApi\Shared\Component\Domain\Extension\Collection\Exceptions\InvalidCollectionItem;
use Ds\Collection;

abstract class AbstractCollection implements Collection, \ArrayAccess
{
    protected array $items = [];

    public function __construct(mixed ...$items)
    {
        array_push($this->items, $items);
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function copy(): Collection
    {
        return clone $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetUnset(mixed $offset): void
    {
        if (isset($this->items[$offset]))
            unset($this->items[$offset]);
    }

    public function jsonSerialize(): mixed
    {
        foreach ($this->items as $item) {
            if (!$item instanceof \JsonSerializable) {
                throw new ItemsMustBeSerializableToJson(
                    sprintf(
                        'Items in [%s] must be serializable to json. [%s] is not.',
                        $this,
                        $item
                    )
                );
            }
        }
    }

    /**
     * @throws InvalidCollectionItem
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_a($value, static::class)) {
            throw new InvalidCollectionItem(
                $value,
                $this
            );
        }

        $this->items[$offset] = $value;
    }
}
