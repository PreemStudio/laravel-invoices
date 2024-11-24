<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Representative;

it('can create a representative instance with all fields', function (): void {
    $representative = Representative::make(
        title: 'Mr.',
        firstName: 'John',
        middleName: 'A',
        lastName: 'Doe',
        email: 'john@example.com',
        phone: '+1-555-555-5555',
    );

    expect($representative->title)->toBe('Mr.');
    expect($representative->firstName)->toBe('John');
    expect($representative->middleName)->toBe('A');
    expect($representative->lastName)->toBe('Doe');
    expect($representative->email)->toBe('john@example.com');
    expect($representative->phone)->toBe('+1-555-555-5555');
});

it('can create a representative instance without optional fields', function (): void {
    $representative = Representative::make(
        firstName: 'Jane',
        lastName: 'Doe',
    );

    expect($representative->title)->toBeNull();
    expect($representative->firstName)->toBe('Jane');
    expect($representative->middleName)->toBeNull();
    expect($representative->lastName)->toBe('Doe');
    expect($representative->email)->toBeNull();
    expect($representative->phone)->toBeNull();
});
