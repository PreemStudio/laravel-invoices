<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Data;

use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Data\Concerns\SumsMoney;
use BaseCodeOy\Invoices\Money\Money;

final class InvoiceItem extends AbstractData
{
    use SumsMoney;

    /**
     * @param array<int, Discount> $discounts
     */
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly int $quantity,
        public readonly string $unit,
        public readonly Money $rate,
        public readonly TaxRate $taxRate,
        public readonly ?array $discounts,
    ) {
        //
    }

    public function discount(): Money
    {
        $money = Money::make(0);

        if (empty($this->discounts)) {
            return $money;
        }

        $total = $this->subtotal()->add($this->tax());

        foreach ($this->discounts as $discount) {
            $money = $discount->calculate($total);
        }

        return $money;
    }

    public function subtotal(): Money
    {
        return $this->rate->multiply($this->quantity);
    }

    public function tax(): Money
    {
        if ($this->taxRate->inclusive) {
            return Money::make(0, $this->rate->getCurrency());
        }

        return $this->subtotal()->multiply($this->taxRate->percentage)->divide(100);
    }

    public function total(): Money
    {
        return $this
            ->subtotal()
            ->add($this->tax())
            ->subtract($this->discount());
    }
}
