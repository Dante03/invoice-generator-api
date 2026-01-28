<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    public static function generate(array $invoice): string
    {
        $pdf = Pdf::loadView('pdf.invoice', $invoice);
        $name = uniqid();
        $path = 'invoices/'.$name.'.pdf';
        Storage::put($path, $pdf->output());

        return $name.'.pdf';
    }
}
