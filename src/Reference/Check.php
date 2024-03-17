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

class Check implements CheckInterface
{
    public function __construct(
        public string $identifier,
        public string $componentId,
        public ComponentType $componentType,
        public Status $status,
        public string $observedValue,
        public string $observedUnit,
        public string $output,
        public \DateTime $time,
    ) {}

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getComponentId(): string
    {
        return $this->componentId;
    }

    public function getComponentType(): string
    {
        return $this->componentType->value;
    }

    public function getStatus(): string
    {
        return $this->status->value;
    }

    public function getObservedValue(): string
    {
        return $this->observedValue;
    }

    public function getObservedUnit(): string
    {
        return $this->observedUnit;
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function getTime(): string
    {
        // $format = 'Y-m-d\TH:i:s.uP';
        $format = 'Y-m-d\TH:i:sP';
        return $this->time->format($format);
    }
}
