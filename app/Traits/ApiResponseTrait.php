<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function success($message = 'Success', $data = [], $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function error($message = 'Something went wrong', $errors = [], $code = 422)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}
