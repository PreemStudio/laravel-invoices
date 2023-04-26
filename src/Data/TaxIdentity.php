<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Data;

final class TaxIdentity extends AbstractData
{
    public function __construct(
        public readonly string $type,
        public readonly string $code,
    ) {
        //
    }
}
