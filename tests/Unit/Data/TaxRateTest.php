<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\Invoices\Data\Country;
use BombenProdukt\Invoices\Data\TaxRate;

it('can create a tax rate instance with inclusive tax', function (): void {
    $country = Country::make(
        name: 'United States',
        code: 'US',
    );

    $taxRate = TaxRate::make(
        country: $country,
        percentage: 10,
        inclusive: true,
    );

    expect($taxRate->country)->toBe($country);
    expect($taxRate->percentage)->toBe(10);
    expect($taxRate->inclusive)->toBeTrue();
});

it('can create a tax rate instance with exclusive tax', function (): void {
    $country = Country::make(
        name: 'United States',
        code: 'US',
    );

    $taxRate = TaxRate::make(
        country: $country,
        percentage: 10,
        inclusive: false,
    );

    expect($taxRate->country)->toBe($country);
    expect($taxRate->percentage)->toBe(10);
    expect($taxRate->inclusive)->toBeFalse();
});
