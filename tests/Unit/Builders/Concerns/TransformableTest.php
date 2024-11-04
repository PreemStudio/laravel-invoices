<?php

declare(strict_types=1);

namespace Tests\Unit\Builders\Concerns;

use Barryvdh\DomPDF\PDF;
use BaseCodeOy\Invoices\Builders\InvoiceBuilder;
use BaseCodeOy\Invoices\Data\Invoice;
use BaseCodeOy\Invoices\Discounts\AmountDiscount;
use BaseCodeOy\Invoices\Discounts\PercentageDiscount;
use Illuminate\Http\Response;
use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('builds an invoice from the data', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems());

    expect($builder->toInvoice())->toBeInstanceOf(Invoice::class);
});

it('builds HTML from the invoice', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems());

    expect($builder->toHtml())->toBeString();
    assertMatchesHtmlSnapshot($builder->toHtml());
});

it('builds HTML from the invoice with discounts', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems())
        ->setDiscounts([
            new AmountDiscount(100000),
            new PercentageDiscount(10),
        ]);

    expect($builder->toHtml())->toBeString();
    assertMatchesHtmlSnapshot($builder->toHtml());
});

it('builds a PDF from the invoice', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems());

    expect($builder->toPdf())->toBeInstanceOf(PDF::class);
});

it('builds a stream from the invoice', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems());

    expect($builder->toStream())->toBeInstanceOf(Response::class);
});

it('builds a download from the invoice', function (): void {
    $builder = (new InvoiceBuilder())
        ->setIdentifier('INV-001')
        ->setCustomer(getCustomer())
        ->setVendor(getVendor())
        ->setItems(getInvoiceItems());

    expect($builder->toDownload())->toBeInstanceOf(Response::class);
});
