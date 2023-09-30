<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as FortifyLoginResponse;
use Illuminate\Support\Facades\Log;

class LoginResponse implements FortifyLoginResponse
{
    public function toResponse($request): JsonResponse
    {
        Log::info('sorongueli');
        $user = $request->user();
        
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }
}