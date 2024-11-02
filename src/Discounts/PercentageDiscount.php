<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Discounts;

use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Money\Money;

final readonly class PercentageDiscount implements Discount
{
    public function __construct(private readonly int $percentage)
    {
        //
    }

    public function calculate(Money $money): Money
    {
        return $money
            ->multiply($this->percentage)
            ->divide(100);
    }
}
