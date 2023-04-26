<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\Invoices\Data\Invoice;
use BombenProdukt\Invoices\Discounts\AmountDiscount;
use BombenProdukt\Invoices\Discounts\PercentageDiscount;
use Carbon\CarbonImmutable;

it('can calculate the subtotal, tax and total', function (bool $inclusive, string $subtotal, string $tax, string $total): void {
    $invoice = Invoice::make(
        identifier: '00001',
        date: CarbonImmutable::now(),
        customer: getCustomer(),
        vendor: getVendor(),
        items: getInvoiceItems($inclusive),
    );

    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '1000000', '0', '1000000'],
    [false, '1000000', '240000', '1240000'],
]);

it('can calculate the subtotal, tax and total with a flat discount', function (bool $inclusive, string $subtotal, string $tax, string $total): void {
    $invoice = Invoice::make(
        identifier: '00001',
        date: CarbonImmutable::now(),
        customer: getCustomer(),
        vendor: getVendor(),
        items: getInvoiceItems($inclusive),
        discounts: [new AmountDiscount(100000)],
    );

    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '1000000', '0', '900000'],
    [false, '1000000', '240000', '1140000'],
]);

it('can calculate the subtotal, tax and total with a percentage discount', function (bool $inclusive, string $subtotal, string $tax, string $total): void {
    $invoice = Invoice::make(
        identifier: '00001',
        date: CarbonImmutable::now(),
        customer: getCustomer(),
        vendor: getVendor(),
        items: getInvoiceItems($inclusive),
        discounts: [new PercentageDiscount(10)],
    );

    expect($invoice->subtotal()->getAmount())->toBe($subtotal);
    expect($invoice->tax()->getAmount())->toBe($tax);
    expect($invoice->total()->getAmount())->toBe($total);
})->with([
    [true, '1000000', '0', '900000'],
    [false, '1000000', '240000', '1116000'],
]);
