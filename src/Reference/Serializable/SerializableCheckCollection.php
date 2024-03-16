<?php

declare(strict_types=1);

/*
 * This file is part of the CMS Health Project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the MIT License.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Cfhack\CmsHealth\Reference\Serializable;

class SerializableCheckCollection implements SerializableCheckCollectionInterface
{
    /**
     * @var array<string, SerializableCheckInterface>
     */
    private array $checks = [];

    public function add(SerializableCheckInterface ...$checks): void
    {
        foreach ($checks as $check) {
            $this->checks[$check->getIdentifier()] = $check;
        }
    }

    public function delete(SerializableCheckInterface|string ...$checks): void
    {
        foreach ($checks as $check) {
            $identifier = is_string($check)
                ? $check
                : $check->getIdentifier();
            unset($this->checks[$identifier]);
        }
    }

    public function has(string $identifier): bool
    {
        return ($this->checks[$identifier] ?? null) !== null;
    }

    public function get(string $identifier): SerializableCheckInterface|null
    {
        return $this->has($identifier)
            ? $this->checks[$identifier]
            : null;
    }

    /**
     * @return array<string, SerializableCheckInterface>
     */
    public function items(): array
    {
        return $this->checks;
    }

    /**
     * @return array<string, SerializableCheckInterface>
     */
    public function jsonSerialize(): array
    {
        return $this->items();
    }
}
