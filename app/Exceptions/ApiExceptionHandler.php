<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return response()->json($e->getMessage(), 422);
        } elseif ($e instanceof HttpException && $e->getStatusCode() == 500) {
            Log::error($e);
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
        return parent::render($request, $e);
    }
}
