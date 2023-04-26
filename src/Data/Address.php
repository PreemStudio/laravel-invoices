<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Data;

use CommerceGuys\Addressing\Address as PostalAddress;
use CommerceGuys\Addressing\AddressFormat\AddressFormatRepository;
use CommerceGuys\Addressing\Country\CountryRepository;
use CommerceGuys\Addressing\Formatter\DefaultFormatter;
use CommerceGuys\Addressing\Formatter\PostalLabelFormatter;
use CommerceGuys\Addressing\Subdivision\SubdivisionRepository;

final class Address extends AbstractData
{
    public function __construct(
        public readonly string $line1,
        public readonly ?string $line2,
        public readonly string $postalCode,
        public readonly string $city,
        public readonly ?string $state,
        public readonly ?string $province,
        public readonly string $country,
        public readonly ?string $countryCode,
    ) {
        //
    }

    public function toString(): string
    {
        $formatter = new DefaultFormatter(
            new AddressFormatRepository(),
            new CountryRepository(),
            new SubdivisionRepository(),
            ['html' => false],
        );

        return $formatter->format($this->toPostalAddress());
    }

    public function toHtml(): string
    {
        $formatter = new DefaultFormatter(
            new AddressFormatRepository(),
            new CountryRepository(),
            new SubdivisionRepository(),
        );

        return $formatter->format($this->toPostalAddress());
    }

    public function toPostalLabel(): string
    {
        $formatter = new PostalLabelFormatter(
            new AddressFormatRepository(),
            new CountryRepository(),
            new SubdivisionRepository(),
        );

        return $formatter->format($this->toPostalAddress(), ['origin_country' => $this->countryCode]);
    }

    private function toPostalAddress(): PostalAddress
    {
        $address = new PostalAddress();

        if ($this->line1) {
            $address = $address->withAddressLine1($this->line1);
        }

        if ($this->line2) {
            $address = $address->withAddressLine2($this->line2);
        }

        if ($this->postalCode) {
            $address = $address->withPostalCode($this->postalCode);
        }

        if ($this->city) {
            $address = $address->withLocality($this->city);
        }

        if ($this->state) {
            $address = $address->withAdministrativeArea($this->state);
        }

        if ($this->province) {
            $address = $address->withAdministrativeArea($this->province);
        }

        if ($this->country) {
            $address = $address->withCountryCode($this->countryCode);
        }

        return $address;
    }
}
