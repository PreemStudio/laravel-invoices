<?php

declare(strict_types=1);

namespace BaseCodeOy\Invoices\Builders;

use BaseCodeOy\Invoices\Builders\Concerns\Transformable;
use BaseCodeOy\Invoices\Contracts\Discount;
use BaseCodeOy\Invoices\Data\Address;
use BaseCodeOy\Invoices\Data\Customer;
use BaseCodeOy\Invoices\Data\InvoiceItem;
use BaseCodeOy\Invoices\Data\Representative;
use BaseCodeOy\Invoices\Data\TaxIdentity;
use BaseCodeOy\Invoices\Data\Vendor;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

final class InvoiceBuilder
{
    use Transformable;

    private ?string $identifier = null;

    private ?string $identifierSeries = null;

    private ?string $identifierFormat = null;

    private ?CarbonImmutable $date = null;

    private ?string $dateFormat = null;

    private ?CarbonImmutable $dueDate = null;

    private ?string $status = null;

    private ?Customer $customer = null;

    private ?Vendor $vendor = null;

    /**
     * @var array<InvoiceItem>
     */
    private array $items = [];

    /**
     * @var array<Discount>
     */
    private array $discounts = [];

    public function __construct()
    {
        $this->identifierSeries = config('invoices.identifier.series');
        $this->identifierFormat = config('invoices.identifier.format');
        $this->date = CarbonImmutable::now();
        $this->dateFormat = config('invoices.date.format');
        $this->dueDate = $this->date->addDays(config('invoices.date.due'));

        if (config('invoices.id.series')) {
            $this->vendor = Vendor::make(
                representative: Representative::from(config('invoices.vendor.representative')),
                address: Address::from(config('invoices.vendor.address')),
                taxIdentity: TaxIdentity::from(config('invoices.vendor.tax_identity')),
            );
        }
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setIdentifierSeries(string $identifierSeries): self
    {
        $this->identifierSeries = $identifierSeries;

        return $this;
    }

    public function setIdentifierFormat(string $identifierFormat): self
    {
        $this->identifierFormat = $identifierFormat;

        return $this;
    }

    public function setDate(Carbon $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function setDateFormat(string $dateFormat): self
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    public function setDueDate(Carbon $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function setVendor(Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function addItem(InvoiceItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param array<InvoiceItem> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function addDiscount(Discount $discount): self
    {
        $this->discounts[] = $discount;

        return $this;
    }

    /**
     * @param array<Discount> $discounts
     */
    public function setDiscounts(array $discounts): self
    {
        $this->discounts = $discounts;

        return $this;
    }
}
