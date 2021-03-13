<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login']]);
	}

	public function index()
	{
		return response()->json([
			'error' => false,
			'message' => 'Consume API please contact me'
		]);
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|string|min:6',
			'device_name' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		$user = User::where('username', $request->username)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'username' => ['The provided credentials are incorrect.'],
			]);
		}

		return response()->json([
			'user' => $user,
			'token' => $user->createToken($request->device_name)->plainTextToken,
		], 200);
	}

	public function signout(Request $request)
	{
		$user = $request->user();
		$user->tokens()->delete();
		return response()->json(['message' => 'User successfully signed out']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh(Request $request)
	{
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function profile(Request $request)
	{
		return response()->json($request->user());
	}

	public function forgot(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$user = '';
			return response()->json(['data' => $user], 200);
		}
	}
}
