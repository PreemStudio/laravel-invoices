<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Money;

use BaseCodeOy\Invoices\Money\Money;
use Money\Currency;

it('formats money correctly without specifying a locale', function (): void {
    $money = Money::make(500, new Currency('USD'));

    expect($money->toString())->toMatchSnapshot();
});

it('formats money correctly with a specified locale', function (): void {
    $money = Money::make(500, new Currency('USD'));

    expect($money->toString('en_US'))->toMatchSnapshot();
});

it('formats money correctly with a different locale', function (): void {
    $money = Money::make(500, new Currency('EUR'));

    expect($money->toString('de_DE'))->toMatchSnapshot();
});

it('formats money correctly with a non-default currency', function (): void {
    $money = Money::make(1_000, new Currency('JPY'));

    expect($money->toString('ja_JP'))->toMatchSnapshot();
});
