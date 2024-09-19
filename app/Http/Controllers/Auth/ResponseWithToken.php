<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;

trait ResponseWithToken
{
    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    private function respondWithToken(string $token): JsonResponse
    {
        /** @psalm-suppress PossiblyUndefinedMethod,UndefinedInterfaceMethod */
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}