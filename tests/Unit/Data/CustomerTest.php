<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Address;
use BaseCodeOy\Invoices\Data\Customer;
use BaseCodeOy\Invoices\Data\Representative;

it('can create a customer instance', function (): void {
    $representative = Representative::make(
        firstName: 'Jane',
        lastName: 'Doe',
        email: 'jane@example.com',
        phone: '+1-555-555-1234',
    );

    $address = Address::make(
        line1: '456 Main St',
        line2: 'Apt 3C',
        postalCode: '67890',
        city: 'Los Angeles',
        state: 'CA',
        country: 'USA',
    );

    $customer = Customer::make(representative: $representative, address: $address);

    expect($customer->representative)->toBe($representative);
    expect($customer->address)->toBe($address);
    expect($customer->address->line1)->toBe('456 Main St');
    expect($customer->address->line2)->toBe('Apt 3C');
    expect($customer->address->postalCode)->toBe('67890');
    expect($customer->address->city)->toBe('Los Angeles');
    expect($customer->address->state)->toBe('CA');
    expect($customer->address->province)->toBeNull();
    expect($customer->address->country)->toBe('USA');
});
