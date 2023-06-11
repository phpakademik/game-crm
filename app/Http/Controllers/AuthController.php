<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
	public function (LoginRequest $request)
	{
		$user = User::where(['username'=>$request->input('username')])->first();
		if (!$user or Hash::check($request->input('password'),$user->password))	 {
		    return response(['message'=>'error'],401);
		}    	
		$token = $user->createToken('api_token')->plainText;
		return response([
			'token'=>$token,
			'role'=>$user->role,
		]);
	}
}
