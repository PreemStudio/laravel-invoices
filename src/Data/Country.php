<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Data;

final class Country extends AbstractData
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
    ) {
        //
    }
}
