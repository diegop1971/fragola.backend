<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as FortifyLoginResponse;

class LoginResponse implements FortifyLoginResponse
{
    public function toResponse($request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }
}