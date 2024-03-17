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

use Cfhack\CmsHealth\Reference\GlobalCheck;
use Cfhack\CmsHealth\Reference\Status;

class SerializableGlobalCheck extends GlobalCheck implements \JsonSerializable
{
    public function __construct(
        Status $status,
        string $version,
        string $serviceId,
        string $description,
        SerializableCheckCollectionInterface $checks,
    ) {
        parent::__construct($status, $version, $serviceId, $description, $checks);
    }

    public function jsonSerialize(): array
    {
        return [
            'status' => $this->getStatus(),
            'version' => $this->getVersion(),
            'serviceId' => $this->getServiceId(),
            'description' => $this->getDescription(),
            'checks' => $this->getChecks(),
        ];
    }
}
