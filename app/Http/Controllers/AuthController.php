<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
	public function index()
	{
		return response()->json([
			'error' => false, 
			'message' => 'Consume API please contact me'
		]);
	}

	public function signin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$user = User::where([
				'email' => $request->email, 
				'password' => $request->password
			])->get();
			return response()->json(['data' => $user], 200);
		}
	}

	public function forgot(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$user = '';
			return response()->json(['data' => $user], 200);
		}
	}
}
