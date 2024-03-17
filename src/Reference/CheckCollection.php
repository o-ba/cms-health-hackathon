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

namespace Cfhack\CmsHealth\Reference;

use Cfhack\CmsHealth\CheckInterface;

class CheckCollection implements CheckCollectionInterface
{
    /**
     * @var array<string, CheckInterface>
     */
    private array $checks = [];

    public function add(CheckInterface ...$checks): void
    {
        foreach ($checks as $check) {
            $this->checks[$check->identifier] = $check;
        }
    }

    public function delete(CheckInterface|string ...$checks): void
    {
        foreach ($checks as $check) {
            $identifier = is_string($check)
                ? $check
                : $check->identifier;
            unset($this->checks[$identifier]);
        }
    }

    public function has(string $identifier): bool
    {
        return ($this->checks[$identifier] ?? null) !== null;
    }

    public function get(string $identifier): CheckInterface|null
    {
        return $this->has($identifier)
            ? $this->checks[$identifier]
            : null;
    }

    /**
     * @return array<string, CheckInterface>
     */
    public function items(): array
    {
        return $this->checks;
    }
}
