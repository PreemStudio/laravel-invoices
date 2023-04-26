<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\Invoices\Data\TaxIdentity;
use TypeError;

it('can create a tax identity', function (): void {
    $taxIdentity = new TaxIdentity('VAT', '12345');

    expect($taxIdentity->type)->toBe('VAT');
    expect($taxIdentity->code)->toBe('12345');
});

it('throws a TypeError when a non-string value is passed to the constructor', function (): void {
    new TaxIdentity('VAT', 12345);
})->throws(TypeError::class);
