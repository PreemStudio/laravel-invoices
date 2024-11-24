<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Invoices\Data\Concerns;

use BaseCodeOy\Invoices\Money\Money;

trait SumsMoney
{
    protected function sumMoney(\Closure $callback): Money
    {
        /** @var Money */
        $result = null;

        foreach ($this->items as $item) {
            if (null === $result) {
                $result = $callback($item);

                continue;
            }

            $result = $result->add($callback($item));
        }

        return $result;
    }
}
