<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;
use App\Http\Resources\DoctorResource;

class DoctorController extends Controller
{
	public function index()
	{
		$doctors = Doctor::all();

		if ($doctors->count() > 0) {
			return DoctorResource::collection($doctors);
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
			$doctor->clinic_id = $request->clinic_id;
			$doctor->name = $request->name;
			$doctor->save();

			return response()->json(['success' => true, 'data' => $doctor], 201);
		}
	}

	public function show($id)
	{
		$doctor = Doctor::find($id);
		
		if ($doctor) {
			return new DoctorResource($doctor);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
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
			$doctor = Doctor::find($id);
			
			if ($doctor) {
				$doctor->name = $request->name;
				$doctor->save();
				return response()->json(['success' => true, 'data' => $doctor], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$doctor = Doctor::find($id);

		if ($doctor) {
			$doctor->delete();
			return response()->json(['success' => true, 'data' => $doctor], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
}
