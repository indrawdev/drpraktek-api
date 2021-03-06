<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Resources\UserResource;
use Exception;

class UserController extends Controller
{
	public function index()
	{
		try {
			$users = User::paginate(15);
			if ($users->count() > 0) {
				return UserResource::collection($users);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|unique:App\Models\User,username',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$user = new User();
				$user->uuid = Str::uuid();
				$user->username = $request->username;
				$user->password = $request->password;

				DB::transaction(function () use ($user) {
					$user->save();
				});

				return response()->json(['success' => true, 'data' => new UserResource($user)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$user = User::with(['profile', 'roles', 'clinics'])->find($id);
			if ($user) {
				return new UserResource($user);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$user = User::find($id);
				if ($user) {
					$user->username = $request->username;

					DB::transaction(function () use ($user) {
						$user->save();
					});

					return response()->json(['success' => true, 'data' => new UserResource($user)], 200);
				} else {
					return response()->json(['error' => 'Not found'], 404);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function destroy($id)
	{
		try {
			$user = User::find($id);
			if ($user) {
				$user->delete();
				return response()->json(['success' => true, 'data' => new UserResource($user)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function reset(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'user_id' => 'required|exists:App\Models\User,id',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$user = User::find($request->user_id);
				if ($user) {
					$user->password = bcrypt($request->password);
					$user->save();
					return response()->json(['success' => true, 'data' => new UserResource($user)], 200);
				} else {
					return response()->json(['error' => 'Not found'], 404);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}
}
