<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Contracts;

use BombenProdukt\Invoices\Money\Money;

interface Discount
{
    public function calculate(Money $money): Money;
}
