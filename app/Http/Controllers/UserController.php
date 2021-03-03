<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
	public function index()
	{
		$users = User::all();

		if ($users->count() > 0) {
			return UserResource::collection($users);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|unique:App\Models\User,email',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			$user = new User();
			$user->email = $request->email;
			$user->password = $request->password;
			$user->save();

			return response()->json(['success' => true, 'data' => $user], 201);
		}
	}

	public function show($id)
	{
		$user = User::find($id);

		if ($user) {
			return new UserResource(User::findOrFail($id));
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$user = User::find($id);
			
			if ($user) {
				$user->name = $request->name;
				$user->save();
				return response()->json(['success' => true, 'data' => $user], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ($user) {
			$user->delete();
			return response()->json(['success' => true, 'data' => $user], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}
}
