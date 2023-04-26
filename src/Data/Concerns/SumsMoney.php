<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Data\Concerns;

use BombenProdukt\Invoices\Money\Money;
use Closure;

trait SumsMoney
{
    protected function sumMoney(Closure $callback): Money
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
