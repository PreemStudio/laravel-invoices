<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\TaxIdentity;

it('can create a tax identity', function (): void {
    $taxIdentity = new TaxIdentity('VAT', '12345');

    expect($taxIdentity->type)->toBe('VAT');
    expect($taxIdentity->code)->toBe('12345');
});

it('throws a TypeError when a non-string value is passed to the constructor', function (): void {
    new TaxIdentity('VAT', 12_345);
})->throws(\TypeError::class);
