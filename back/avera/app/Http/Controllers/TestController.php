<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request){

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => 'password'
        ]);
        $getToken = $user->createToken('API_TOKEN')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $getToken,
        ]);
    }
}
