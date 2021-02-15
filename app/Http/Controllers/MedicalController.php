<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Medical;

class MedicalController extends Controller
{
	public function index()
	{
		$medicals = Medical::all();

		if ($medicals->count() > 0) {
			return response()->json(['data' => $medicals], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required',
			'doctor_id' => 'required',
			'patient_id' => 'required',
			'anamnesa' => 'required',
			'diagnosis' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$medical = new Medical();
			$medical->clinic_id = $request->clinic_id;
			$medical->doctor_id = $request->doctor_id;
			$medical->patient_id = $request->patient_id;
			$medical->anamnesa = $request->anamnesa;
			$medical->diagnosis = $request->diagnosis;
			$medical->action = $request->action;
			$medical->total = $request->total;
			$medical->save();

			return response()->json(['success' => true, 'data' => $medical], 201);
		}
	}

	public function show($id)
	{
		$medical = Medical::findOrFail($id);

		if ($medical->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $medical], 200);
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
			$medical = Medical::findOrFail($id);
			$medical->anamnesa = $request->anamnesa;
			$medical->diagnosis = $request->diagnosis;
			$medical->action = $request->action;
			$medical->total = $request->total;
			$medical->save();
	
			return response()->json(['success' => true, 'data' => $medical], 200);
		}
	}

	public function destroy($id)
	{
		$medical = Medical::findOrFail($id);

		if ($medical->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$medical->delete();
			return response()->json(['success' => true, 'data' => $medical], 200);
		}
	}
}
