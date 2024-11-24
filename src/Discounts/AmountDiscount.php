<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Discounts;

use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Money\Money;

final readonly class AmountDiscount implements Discount
{
    public function __construct(
        private readonly int $amount,
    ) {
        //
    }

    public function calculate(Money $money): Money
    {
        return Money::make($this->amount, $money->getCurrency());
    }
}
