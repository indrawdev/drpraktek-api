<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Officer;

class OfficerController extends Controller
{
	public function index()
	{
		$officers = Officer::all();

		if ($officers->count() > 0) {
			return response()->json(['data' => $officers], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$officer = new Officer();
			$officer->name = $request->name;
			$officer->save();

			return response()->json(['success' => true, 'data' => $officer], 201);
		}
	}

	public function show($id)
	{
		$officer = Officer::findOrFail($id);
		
		if ($officer->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $officer], 200);
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
			$officer = Officer::findOrFail($id);
			$officer->name = $request->name;
			$officer->save();
	
			return response()->json(['success' => true, 'data' => $officer], 200);
		}
	}

	public function destroy($id)
	{
		$officer = Officer::findOrFail($id);

		if ($officer->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$officer->delete();
			return response()->json(['success' => true, 'data' => $officer], 200);
		}
	}
}
