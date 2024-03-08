<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $request->authenticate();

        $request->session()->regenerate();

        $token = Auth::user()->createToken('API_TOKEN');

        return response()->json([
            'user' => Auth::user(),
            'token' => $token->plainTextToken

        ]);
    }

    /**
     * Destroy an authenticated session.
     */
//    public function destroy(Request $request): \Illuminate\Http\JsonResponse
//    {
//        $request->user()->tokens->delete();
//
//        return response()->json(['name' => 'sl']);
//    }
}
