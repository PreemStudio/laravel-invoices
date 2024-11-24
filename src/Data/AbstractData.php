<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Data;

use Spatie\LaravelData\Data;

abstract class AbstractData extends Data
{
    public static function make(mixed ...$attributes): static
    {
        return static::from($attributes);
    }
}
