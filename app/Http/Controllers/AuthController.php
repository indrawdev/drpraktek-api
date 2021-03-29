<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserResource;
use Exception;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:sanctum', ['except' => ['login', 'forgot']]);
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
			'username' => 'required|string|exists:App\Models\User,username',
			'password' => 'required|string|min:6',
			'device_name' => 'required|string'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		} else {

			try {
				$user = User::with(['profile', 'roles', 'clinics'])->where('username', $request->username)->first();

				if (!$user || !Hash::check($request->password, $user->password)) {
					return response()->json(['error' => 'Incorrect user'], 404);
				} else {
					return response()->json([
						'user' => new UserResource($user),
						'token' => $user->createToken($request->device_name)->plainTextToken,
					], 200);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function logout(Request $request)
	{
		try {
			$user = $request->user();
			$user->tokens()->delete();
			return response()->json(['message' => 'User successfully logout']);
		} catch (Exception $e) {
			return $e;
		}
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
	public function profile($uuid)
	{
		try {
			$user = User::with('profile')->where('uuid', $uuid)->first();
			return new UserResource($user);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function forgot(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string|exists:App\Models\User,username'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$user = User::where('username', $request->username)->first();
				if ($user) {
					return new UserResource($user);
				} else {
					return response()->json(['error' => 'Incorrect user'], 404);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}
}
