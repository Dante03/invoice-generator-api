<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function download($file)
    {
        if (! Storage::disk('invoices')->exists($file)) {
            abort(404, "Archivo no encontrado: {$file}");
        }

        $path = Storage::disk('invoices')->path($file);

        return response()->download($path, basename($file));
    }
}
