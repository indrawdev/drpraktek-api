<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;

class DoctorController extends Controller
{
	public function index()
	{
		$doctors = Doctor::all();

		if ($doctors->count() > 0) {
			return response()->json(['data' => $doctors], 200);
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
			$doctor = new Doctor();
			$doctor->name = $request->name;
			$doctor->save();

			return response()->json(['success' => true, 'data' => $doctor], 201);
		}
	}

	public function show($id)
	{
		$doctor = Doctor::findOrFail($id);
		
		if ($doctor->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $doctor], 200);
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
			$doctor = Doctor::findOrFail($id);
			$doctor->name = $request->name;
			$doctor->save();
	
			return response()->json(['success' => true, 'data' => $doctor], 200);
		}
	}

	public function destroy($id)
	{
		$doctor = Doctor::findOrFail($id);

		if ($doctor->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$doctor->delete();
			return response()->json(['success' => true, 'data' => $doctor], 200);
		}
	}
}
