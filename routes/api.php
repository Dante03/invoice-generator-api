<?php
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

Route::post('/invoices', [InvoiceController::class, 'store']);
Route::get('/download/invoice/{file}', [PdfController::class, 'download']);
