<?php

declare(strict_types=1);

namespace Tests\Unit\Money;

use Money\Currency;
use BombenProdukt\Invoices\Money\Money;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('formats money correctly without specifying a locale', function (): void {
    $money = Money::make(500, new Currency('USD'));

    assertMatchesSnapshot($money->toString());
});

it('formats money correctly with a specified locale', function (): void {
    $money = Money::make(500, new Currency('USD'));

    assertMatchesSnapshot($money->toString('en_US'));
});

it('formats money correctly with a different locale', function (): void {
    $money = Money::make(500, new Currency('EUR'));

    assertMatchesSnapshot($money->toString('de_DE'));
});

it('formats money correctly with a non-default currency', function (): void {
    $money = Money::make(1000, new Currency('JPY'));

    assertMatchesSnapshot($money->toString('ja_JP'));
});
