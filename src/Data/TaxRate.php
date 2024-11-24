<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Data;

/**
 * The term TAX INCLUSIVE is used when describing a price that already includes tax.
 * The term TAX EXCLUSIVE is used when describing a price to which tax is yet to be added to arrive at the final cost.
 */
final class TaxRate extends AbstractData
{
    public function __construct(
        public readonly Country $country,
        public readonly int $percentage,
        public readonly bool $inclusive,
    ) {
        //
    }
}
