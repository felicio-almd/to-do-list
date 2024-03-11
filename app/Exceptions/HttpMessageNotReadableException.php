<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class HttpMessageNotReadableException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => 'Bad Request',
            'message' => $this->getMessage(),
        ], 400);
    }
}
