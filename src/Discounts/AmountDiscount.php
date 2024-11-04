<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Discounts;

use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Money\Money;

final readonly class AmountDiscount implements Discount
{
    public function __construct(private readonly int $amount)
    {
        //
    }

    public function calculate(Money $money): Money
    {
        return Money::make($this->amount, $money->getCurrency());
    }
}
