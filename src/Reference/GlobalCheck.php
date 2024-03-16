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

use Cfhack\CmsHealth\GlobalCheckInterface;

class GlobalCheck implements GlobalCheckInterface
{
    public function __construct(
        public Status $status,
        public string $version,
        public string $serviceId,
        public string $description,
        public CheckCollectionInterface $checks,
    ) {}

    public function getStatus(): string
    {
        return $this->status->value;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array<string, Check>
     */
    public function getChecks(): array
    {
        return $this->checks->items();
    }
}
