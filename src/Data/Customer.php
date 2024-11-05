<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Data;

final class Customer extends AbstractData
{
    public function __construct(
        public readonly Representative $representative,
        public readonly Address $address,
        public readonly ?TaxIdentity $taxIdentity,
    ) {
        //
    }
}
