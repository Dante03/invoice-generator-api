<?php

namespace App\Domain\Invoice;

use App\Exceptions\BusinessRuleException;

class InvoiceValidator
{
    public static function validate(array $items): void
    {
        $types = collect($items)->pluck('type')->unique();

        if ($types->count() > 1) {
            throw new BusinessRuleException(
                'No se pueden mezclar productos y servicios en la misma factura'
            );
        }
    }
}
