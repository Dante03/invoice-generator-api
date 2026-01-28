<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\StoreInvoiceRequest;
use App\Services\PdfService;
use App\Domain\Invoice\InvoiceCalculator;
use App\Domain\Invoice\InvoiceValidator;

class InvoiceController extends Controller
{
    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();

        InvoiceValidator::validate($data['items']);

        $totals = InvoiceCalculator::calculate(
            $data['items'],
            $data['taxRate'] ?? 0
        );

        $pdfUrl = PdfService::generate([
            'items' => $data['items'],
            'totals' => $totals
        ]);

        return response()->json([
            'totals' => $totals,
            'pdf_url' => $pdfUrl
        ]);
    }
}
