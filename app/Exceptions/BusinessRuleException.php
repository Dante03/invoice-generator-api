<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BusinessRuleException extends Exception
{
    protected int $status;

    public function __construct(
        string $message,
        int $status = 422
    ) {
        parent::__construct($message);
        $this->status = $status;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'type' => 'BUSINESS_RULE_VIOLATION'
        ], $this->status);
    }
}