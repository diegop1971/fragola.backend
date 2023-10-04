<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LoginResponse as FortifyLoginResponse;

class LoginResponse implements FortifyLoginResponse
{
    public function toResponse($request): JsonResponse
    {
        $user = $request->user();
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                //'avatar' => $user->avatar,
                //'roles' => $user->roles,
            ],
        ]);
    }
}