<?php

declare(strict_types=1);

use BaseCodeOy\Invoices\Data\Address;
use BaseCodeOy\Invoices\Data\Country;
use BaseCodeOy\Invoices\Data\Customer;
use BaseCodeOy\Invoices\Data\InvoiceItem;
use BaseCodeOy\Invoices\Data\Representative;
use BaseCodeOy\Invoices\Data\TaxRate;
use BaseCodeOy\Invoices\Data\Vendor;
use BaseCodeOy\Invoices\Money\Money;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

uses(
    Tests\TestCase::class,
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function getInvoiceItems(bool $inclusive = false): array
{
    return [
        InvoiceItem::make(
            name: 'Logo redesign',
            description: 'New logo and digital asset playbook.',
            quantity: 25,
            unit: 'hour',
            rate: Money::make(10000),
            taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        ),
        InvoiceItem::make(
            name: 'Website redesign',
            description: 'Design and program new company website.',
            quantity: 25,
            unit: 'hour',
            rate: Money::make(10000),
            taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        ),
        InvoiceItem::make(
            name: 'Business cards',
            description: 'Design and production of 3.5&quot; x 2.0&quot; business cards.',
            quantity: 25,
            unit: 'hour',
            rate: Money::make(10000),
            taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        ),
        InvoiceItem::make(
            name: 'T-shirt design',
            description: 'Three t-shirt design concepts.',
            quantity: 25,
            unit: 'hour',
            rate: Money::make(10000),
            taxRate: new TaxRate(new Country('Finland', 'FI'), 24, $inclusive),
        ),
    ];
}

function getVendor(): Vendor
{
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
        countryCode: 'US',
    );

    return Vendor::make(representative: $representative, address: $address);
}

function getCustomer(): Customer
{
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
        countryCode: 'US',
    );

    return Customer::make(representative: $representative, address: $address);
}
