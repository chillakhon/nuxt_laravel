<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function Psy\debug;

class UserController extends Controller
{
//    public function getUser(Request $request)
//    {
//        //$user = $request->session()->get('user');
//
//        if($user) {
//            return response()->json([
//                'user' => $user,
//            ], 200);
//        } else {
//            return response()->json(['user'=>'not'], 401);
//        }
//    }
}
