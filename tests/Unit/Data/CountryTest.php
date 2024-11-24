<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Country;

it('can create a country instance', function (): void {
    $country = Country::make(
        name: 'United States',
        code: 'US',
    );

    expect($country->name)->toBe('United States');
    expect($country->code)->toBe('US');
});

it('can create another country instance', function (): void {
    $country = Country::make(
        name: 'United Kingdom',
        code: 'UK',
    );

    expect($country->name)->toBe('United Kingdom');
    expect($country->code)->toBe('UK');
});
