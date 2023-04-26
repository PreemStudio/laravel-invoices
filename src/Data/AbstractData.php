<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Data;

use Spatie\LaravelData\Data;

abstract class AbstractData extends Data
{
    public static function make(mixed ...$attributes): static
    {
        return static::from($attributes);
    }
}
