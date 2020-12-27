<?php

namespace App\Traits;

trait ApiResponse
{
    public function response($message, $status)
    {
        return response()->json([
            'message' => $message
        ], $status);
    }

    public function error($message, $status)
    {
        return response()->json([
            'error' => $message
        ], $status);
    }
}
