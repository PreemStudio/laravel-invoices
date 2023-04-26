<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Discounts;

use BombenProdukt\Invoices\Contracts\Discount;
use BombenProdukt\Invoices\Money\Money;

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
