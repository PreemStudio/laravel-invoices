<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Data;

final class Representative extends AbstractData
{
    public function __construct(
        public readonly ?string $title,
        public readonly string $firstName,
        public readonly ?string $middleName,
        public readonly string $lastName,
        public readonly ?string $email,
        public readonly ?string $phone,
    ) {
        //
    }
}
