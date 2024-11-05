<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Contracts;

use BaseCodeOy\Invoices\Money\Money;

interface Discount
{
    public function calculate(Money $money): Money;
}
