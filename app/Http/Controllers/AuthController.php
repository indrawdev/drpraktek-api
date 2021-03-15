<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:sanctum', ['except' => ['login']]);
	}

	public function index()
	{
		return response()->json([
			'error' => false,
			'message' => 'Consume API please contact me at indra@ide.web.id'
		]);
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|string|min:6',
			'device_name' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		$user = User::with(['profile', 'roles', 'clinics'])->where('username', $request->username)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			return response()->json([
				'error' => 'Incorrect user'
			], 404);
		}

		return response()->json([
			'user' => new UserResource($user),
			// 'data' => $user,
			'token' => $user->createToken($request->device_name)->plainTextToken,
		], 200);
	}

	public function logout(Request $request)
	{
		$user = $request->user();
		$user->tokens()->delete();
		return response()->json(['message' => 'User successfully logout']);
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
	public function profile()
	{
		return response(['data' => ''])->json();
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
