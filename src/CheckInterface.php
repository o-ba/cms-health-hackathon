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

namespace Cfhack\CmsHealth;

interface CheckInterface
{
    public function getIdentifier(): string;
    public function getComponentId(): string;
    public function getComponentType(): string;
    public function getStatus(): string;
    public function getObservedValue(): string;
    public function getObservedUnit(): string;
    public function getOutput(): string;
    public function getTime(): string;
}
