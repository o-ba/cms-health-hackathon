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

enum Status: string
{
    case Pass = 'pass';
    case Ok = 'ok';
    case Fail = 'fail';
    case Error = 'error';
    case Warn = 'warn';

    public function passes(): bool
    {
        return $this === self::Pass || $this === self::Ok;
    }

    public function failes(): bool
    {
        return $this === self::Fail || $this === self::Error;
    }

    public function warns(): bool
    {
        return $this === self::Warn;
    }
}
