<?php

namespace App\ApiV1\Exception;
use Illuminate\Http\JsonResponse;

use Exception;

class InvalidWithdrawException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([ "error" =>
            [
                "code" => "invalid-withdraw",
                "attribute" => "withdraw",
                "message" => "Invalid Withdraw."
            ]
        ], 400);
    }
}