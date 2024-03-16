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

use Cfhack\CmsHealth\Reference\Check;

class SerializableCheck extends Check implements SerializableCheckInterface
{
    /**
     * @return array{
     *   componentId: string,
     *   componentType: string,
     *   status: string,
     *   observedValue: string,
     *   observedUnit: string,
     *   output: string,
     *   time: string,
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'componentId' => $this->getComponentId(),
            'componentType' => $this->getComponentType(),
            'status' => $this->getStatus(),
            'observedValue' => $this->getObservedValue(),
            'observedUnit' => $this->getObservedUnit(),
            'output' => $this->getOutput(),
            'time' => $this->getTime(),
        ];
    }
}
