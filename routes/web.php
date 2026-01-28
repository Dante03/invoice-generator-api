<?php

use Illuminate\Support\Facades\Route;

Route::get('/invoices', function () {
    // Puedes pasar datos de prueba aquí
    $items = [
        ['id' => '01', 'name' => 'datra', 'quantity' => 2, 'price' => 1000, 'discount' => 10],
    ];

    $totals = [
        'subtotal' => 2000,
        'tax_total' => 320,
        'discount_total' => 200,
        'total' => 2088,
    ];

    return view('pdf.invoice', compact('items', 'totals'));
});
