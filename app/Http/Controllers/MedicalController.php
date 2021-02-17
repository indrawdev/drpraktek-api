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
			'registration_id' => 'required',
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
			$medical->registration_id = $request->registration_id;
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
		$medical = Medical::find($id);

		if ($medical) {
			return response()->json($medical, 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'anamnesa' => 'required',
			'diagnosis' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$medical = Medical::find($id);

			if ($medical) {
				$medical->anamnesa = $request->anamnesa;
				$medical->diagnosis = $request->diagnosis;
				$medical->action = $request->action;
				$medical->total = $request->total;
				$medical->save();
		
				return response()->json(['success' => true, 'data' => $medical], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$medical = Medical::find($id);

		if ($medical) {
			$medical->delete();
			return response()->json(['success' => true, 'data' => $medical], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
}
