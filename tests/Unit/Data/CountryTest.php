<?php

declare(strict_types=1);

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
