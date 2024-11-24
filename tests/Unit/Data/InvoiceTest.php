<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Invoice;
use BaseCodeOy\Invoices\Discounts\AmountDiscount;
use BaseCodeOy\Invoices\Discounts\PercentageDiscount;
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
        discounts: [new AmountDiscount(100_000)],
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
