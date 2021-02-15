<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
	public function index()
	{
		$users = User::all();
		
		if ($users->count() > 0) {
			return response()->json(['data' => $users], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
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
		$user = User::findOrFail($id);
		
		if ($user->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $user], 200);
		}
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);

		if ($user->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$user->delete();
			return response()->json(['success' => true, 'data' => $user], 200);
		}
	}
}
