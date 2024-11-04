<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Country;
use BaseCodeOy\Invoices\Data\InvoiceItem;
use BaseCodeOy\Invoices\Data\TaxRate;
use BaseCodeOy\Invoices\Discounts\AmountDiscount;
use BaseCodeOy\Invoices\Discounts\PercentageDiscount;
use BaseCodeOy\Invoices\Money\Money;

it('can calculate the subtotal, tax and total', function (bool $inclusive, string $subtotal, string $tax, string $total): void {
    $invoice = InvoiceItem::make(
        name: 'Logo redesign',
        description: 'New logo and digital asset playbook.',
        quantity: 100,
        unit: 'hour',
        rate: Money::make(10000),
        taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
    );

    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '1000000', '0', '1000000'],
    [false, '1000000', '240000', '1240000'],
]);

it('can calculate the subtotal, tax and total with a flat discount', function (bool $inclusive, string $discount, string $subtotal, string $tax, string $total): void {
    $invoice = InvoiceItem::make(
        name: 'Logo redesign',
        description: 'New logo and digital asset playbook.',
        quantity: 100,
        unit: 'hour',
        rate: Money::make(10000),
        taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        discounts: [new AmountDiscount(100000)],
    );

    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '100000', '1000000', '0', '900000'],
    [false, '100000', '1000000', '240000', '1140000'],
]);

it('can calculate the subtotal, tax and total with a percentage discount', function (bool $inclusive, string $discount, string $subtotal, string $tax, string $total): void {
    $invoice = InvoiceItem::make(
        name: 'Logo redesign',
        description: 'New logo and digital asset playbook.',
        quantity: 100,
        unit: 'hour',
        rate: Money::make(10000),
        taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        discounts: [new PercentageDiscount(10)],
    );

    expect($invoice->discount()->getAmount())->toBe($discount);
    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '100000', '1000000', '0', '900000'],
    [false, '124000', '1000000', '240000', '1116000'],
]);
