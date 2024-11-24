<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Address;
use BaseCodeOy\Invoices\Data\Representative;
use BaseCodeOy\Invoices\Data\Vendor;

it('can create a vendor instance', function (): void {
    $representative = Representative::make(
        firstName: 'John',
        lastName: 'Doe',
        email: 'john@example.com',
        phone: '+1-555-555-5555',
    );

    $address = Address::make(
        line1: '123 Main St',
        line2: 'Apt 4B',
        postalCode: '12345',
        city: 'New York',
        state: 'NY',
        country: 'USA',
    );

    $company = Vendor::make(representative: $representative, address: $address);

    expect($company->representative)->toBe($representative);
    expect($company->address)->toBe($address);
    expect($company->address->line1)->toBe('123 Main St');
    expect($company->address->line2)->toBe('Apt 4B');
    expect($company->address->postalCode)->toBe('12345');
    expect($company->address->city)->toBe('New York');
    expect($company->address->state)->toBe('NY');
    expect($company->address->province)->toBeNull();
    expect($company->address->country)->toBe('USA');
});
