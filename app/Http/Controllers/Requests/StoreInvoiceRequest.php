<?php
namespace App\Http\Controllers\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.name' => ['required', 'string'],
            'items.*.type' => ['required', 'in:SERVICE,PRODUCT'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.discount' => ['required', 'numeric', 'min:0'],
            'taxRate' => ['numeric', 'min:0']
        ];
    }
}
