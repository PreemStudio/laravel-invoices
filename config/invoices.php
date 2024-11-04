<?php

declare(strict_types=1);

return [
    'identifier' => [
        'series' => env('INVOICES_IDENTIFIER_SERIES', 'INV'),
        'format' => env('INVOICES_IDENTIFIER_FORMAT', '{SEQUENCE}/{SERIES}'),
        'sequence' => env('INVOICES_IDENTIFIER_SEQUENCE', 1),
        'padding' => env('INVOICES_IDENTIFIER_PADDING', 5),
        'delimiter' => env('INVOICES_IDENTIFIER_DELIMITER', '-'),
    ],

    'currency' => [
        'code' => env('INVOICES_CURRENCY_CODE', 'EUR'),
        'symbol' => env('INVOICES_CURRENCY_SYMBOL', '€'),
        'format' => env('INVOICES_CURRENCY_FORMAT', '{SYMBOL}{AMOUNT}'),
    ],

    'date' => [
        'format' => env('INVOICES_DATE_FORMAT', 'd.m.Y'),
        'due' => env('INVOICES_DATE_DUE', 14),
    ],

    'paper' => [
        'size' => env('INVOICES_PAPER_SIZE', 'A4'),
        'orientation' => env('INVOICES_PAPER_ORIENTATION', 'portrait'),
    ],

    'vendor' => [
        'representative' => [
            'title' => env('INVOICES_VENDOR_REPRESENTATIVE_TITLE', 'Mr.'),
            'firstName' => env('INVOICES_VENDOR_REPRESENTATIVE_FIRST_NAME', 'John'),
            'middleName' => env('INVOICES_VENDOR_REPRESENTATIVE_MIDDLE_NAME', 'Doe'),
            'lastName' => env('INVOICES_VENDOR_REPRESENTATIVE_LAST_NAME', 'Smith'),
            'email' => env('INVOICES_VENDOR_REPRESENTATIVE_EMAIL', 'john@doe.xyz'),
            'phone' => env('INVOICES_VENDOR_REPRESENTATIVE_PHONE', '+39 123 456 7890'),
        ],

        'address' => [
            'line1' => env('INVOICES_VENDOR_ADDRESS_LINE1', 'Street Name'),
            'line2' => env('INVOICES_VENDOR_ADDRESS_LINE2', 'Street Number'),
            'postalCode' => env('INVOICES_VENDOR_ADDRESS_POSTAL_CODE', '12345'),
            'city' => env('INVOICES_VENDOR_ADDRESS_CITY', 'City Name'),
            'state' => env('INVOICES_VENDOR_ADDRESS_STATE', 'State Name'),
            'province' => env('INVOICES_VENDOR_ADDRESS_PROVINCE', 'Province Name'),
            'country' => env('INVOICES_VENDOR_ADDRESS_COUNTRY', 'Country Name'),
            'countryCode' => env('INVOICES_VENDOR_ADDRESS_COUNTRY', 'US'),
        ],

        'tax_identity' => [
            'type' => env('INVOICES_VENDOR_TAX_IDENTITY_TYPE', 'VAT'),
            'code' => env('INVOICES_VENDOR_TAX_IDENTITY_NUMBER', '12345678901'),
        ],

        'bank' => [
            'name' => env('INVOICES_VENDOR_BANK_NAME', 'Bank Name'),
            'iban' => env('INVOICES_VENDOR_BANK_IBAN', 'IT12A1234567890123456789012'),
            'swift' => env('INVOICES_VENDOR_BANK_SWIFT', 'BANKITMM'),
        ],
    ],
];
