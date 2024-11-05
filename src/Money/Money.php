<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Money;

use Illuminate\Support\Facades\App;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as BaseMoney;

final readonly class Money
{
    public function __construct(private readonly BaseMoney $money)
    {
        //
    }

    public static function make(int $amount, Currency|string|null $currency = null): self
    {
        if (empty($currency)) {
            $currency = new Currency(config('invoices.currency.code'));
        } elseif (\is_string($currency)) {
            $currency = new Currency($currency);
        }

        return new self(new BaseMoney($amount, $currency));
    }

    public function add(self $addend): self
    {
        return new self($this->money->add($addend->toBase()));
    }

    public function subtract(self $subtrahend): self
    {
        return new self($this->money->subtract($subtrahend->toBase()));
    }

    public function multiply(int $multiplier): self
    {
        return new self($this->money->multiply($multiplier));
    }

    public function divide(int $divisor): self
    {
        return new self($this->money->divide($divisor));
    }

    public function getAmount(): string
    {
        return $this->money->getAmount();
    }

    public function getCurrency(): Currency
    {
        return $this->money->getCurrency();
    }

    public function toBase(): BaseMoney
    {
        return $this->money;
    }

    public function toString(?string $locale = null): string
    {
        $numberFormatter = new \NumberFormatter($locale ?? App::getLocale(), \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        return $moneyFormatter->format($this->money);
    }
}
