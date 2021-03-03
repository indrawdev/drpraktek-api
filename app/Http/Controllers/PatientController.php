<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
	public function index()
	{
		$patients = Patient::all();
		
		if ($patients->count() > 0) {
			return PatientResource::collection($patients);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required|exists:App\Models\Clinic,id',
			'name' => 'required',
			'number' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$patient = new Patient();
			$patient->clinic_id = $request->clinic_id;
			$patient->insurance_id = $request->insurance_id;
			$patient->name = $request->name;
			$patient->number = $request->number;
			$patient->identity = $request->identity;
			$patient->dob = $request->dob;
			$patient->gender = $request->gender;
			$patient->blood = $request->blood;
			$patient->height = $request->height;
			$patient->weight = $request->weight;
			$patient->address = $request->address;
			$patient->phone = $request->phone;
			$patient->insurance_number = $request->insurance_number;
			$patient->save();

			return response()->json(['success' => true, 'data' => $patient], 201);
		}
	}

	public function show($id)
	{
		$patient = Patient::with(['clinic', 'insurance', 'registers', 'medicals', 'letters'])->find($id);
		
		if ($patient) {
			return new PatientResource($patient);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'number' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$patient = Patient::find($id);
			
			if ($patient) {
				$patient->insurance_id = $request->insurance_id;
				$patient->name = $request->name;
				$patient->number = $request->number;
				$patient->identity = $request->identity;
				$patient->dob = $request->dob;
				$patient->gender = $request->gender;
				$patient->blood = $request->blood;
				$patient->height = $request->height;
				$patient->weight = $request->weight;
				$patient->address = $request->address;
				$patient->phone = $request->phone;
				$patient->insurance_number = $request->insurance_number;
				$patient->save();
				return response()->json(['success' => true, 'data' => $patient], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$patient = Patient::find($id);

		if ($patient) {
			$patient->delete();
			return response()->json(['success' => true, 'data' => $patient], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}
}
