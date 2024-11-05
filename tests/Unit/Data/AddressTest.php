<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BaseCodeOy\Invoices\Data\Address;
use function Spatie\Snapshots\assertMatchesHtmlSnapshot;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('can create an address instance', function (): void {
    $address = Address::make(
        line1: '123 Main St',
        line2: 'Apt 4B',
        postalCode: '12345',
        city: 'New York',
        state: 'NY',
        country: 'United States',
        countryCode: 'US',
    );

    expect($address->line1)->toBe('123 Main St');
    expect($address->line2)->toBe('Apt 4B');
    expect($address->postalCode)->toBe('12345');
    expect($address->city)->toBe('New York');
    expect($address->state)->toBe('NY');
    expect($address->province)->toBeNull();
    expect($address->country)->toBe('United States');
    expect($address->countryCode)->toBe('US');
});

it('can create an address instance without optional fields', function (): void {
    $address = Address::make(
        line1: '123 Main St',
        postalCode: '12345',
        city: 'New York',
        country: 'United States',
    );

    expect($address->line1)->toBe('123 Main St');
    expect($address->line2)->toBeNull();
    expect($address->postalCode)->toBe('12345');
    expect($address->city)->toBe('New York');
    expect($address->state)->toBeNull();
    expect($address->province)->toBeNull();
    expect($address->country)->toBe('United States');
});

it('can format the address as a string', function (): void {
    $address = Address::make(
        line1: '123 Main St',
        line2: 'Apt 4B',
        postalCode: '12345',
        city: 'New York',
        state: 'NY',
        country: 'United States',
        countryCode: 'US',
    );

    assertMatchesSnapshot($address->toString());
});

it('can format the address as HTML', function (): void {
    $address = Address::make(
        line1: '123 Main St',
        line2: 'Apt 4B',
        postalCode: '12345',
        city: 'New York',
        state: 'NY',
        country: 'United States',
        countryCode: 'US',
    );

    assertMatchesHtmlSnapshot($address->toHtml());
});

it('can format the address as a postal label', function (): void {
    $address = Address::make(
        line1: '123 Main St',
        line2: 'Apt 4B',
        postalCode: '12345',
        city: 'New York',
        state: 'NY',
        country: 'United States',
        countryCode: 'US',
    );

    assertMatchesSnapshot($address->toPostalLabel());
});
