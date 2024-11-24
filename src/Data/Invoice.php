<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Data;

use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Data\Concerns\SumsMoney;
use BaseCodeOy\Invoices\Money\Money;
use Carbon\CarbonImmutable;

final class Invoice extends AbstractData
{
    use SumsMoney;

    /**
     * @param array<int, InvoiceItem> $items
     * @param array<int, Discount>    $discounts
     */
    public function __construct(
        public readonly string $identifier,
        public readonly CarbonImmutable $date,
        public readonly Customer $customer,
        public readonly Vendor $vendor,
        public readonly array $items,
        public readonly ?array $discounts,
    ) {
        //
    }

    public function discount(): Money
    {
        $totalDiscount = $this->sumMoney(fn (InvoiceItem $item): Money => $item->discount());

        if (empty($this->discounts)) {
            return $totalDiscount;
        }

        $total = $this->sumMoney(fn (InvoiceItem $item): Money => $item->total());

        foreach ($this->discounts as $discount) {
            $totalDiscount = $discount->calculate($total);
        }

        return $totalDiscount;
    }

    public function subtotal(): Money
    {
        return $this->sumMoney(fn (InvoiceItem $item): Money => $item->subtotal());
    }

    public function tax(): Money
    {
        return $this->sumMoney(fn (InvoiceItem $item): Money => $item->tax());
    }

    public function total(): Money
    {
        return $this
            ->subtotal()
            ->add($this->tax())
            ->subtract($this->discount());
    }
}
