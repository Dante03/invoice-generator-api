<?php
namespace App\Domain\Invoice;

class InvoiceCalculator
{
    public static function calculate(array $items, float $tax): array
    {
        $type = $items[0]['type'];

        $subtotal = 0;
        $discountTotal = 0;
        $taxTotal = 0;

        foreach ($items as $item) {
            $base = $item['price'] * $item['quantity'];
            $discount = $base * ($item['discount'] / 100);

            if ($type === 'SERVICE') {
                $taxAmount = ($base - $discount) * $tax;
            } else {
                $taxAmount = $base * $tax;
            }

            $subtotal += $base;
            $discountTotal += $discount;
            $taxTotal += $taxAmount;
        }

        return [
            'subtotal' => $subtotal,
            'discount_total' => $discountTotal,
            'tax_total' => $taxTotal,
            'total' => $subtotal - $discountTotal + $taxTotal
        ];
    }
}
