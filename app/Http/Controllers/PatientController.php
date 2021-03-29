<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Clinic;
use App\Http\Resources\PatientResource;
use Exception;

class PatientController extends Controller
{
	public function index()
	{
		try {
			$patients = Patient::all();
			if ($patients->count() > 0) {
				return PatientResource::collection($patients);
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

			try {
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

				$clinic = Clinic::find($request->clinic_id);

				DB::transaction(function () use ($patient, $clinic) {
					$patient->save();
					$clinic->increment('count_patient', 1);
					$count = Patient::find($patient->id);
					$count->number = $clinic->count_patient;
					$count->save();
				});

				return response()->json(['success' => true, 'data' => new PatientResource($patient)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$patient = Patient::with(['clinic', 'insurance', 'registers', 'medicals', 'letters'])->find($id);
			if ($patient) {
				return new PatientResource($patient);
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
			'name' => 'required',
			'number' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
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

					DB::transaction(function () use ($patient) {
						$patient->save();
					});

					return response()->json(['success' => true, 'data' => new PatientResource($patient)], 200);
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
			$patient = Patient::find($id);
			if ($patient) {
				$patient->delete();
				return response()->json(['success' => true, 'data' => new PatientResource($patient)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}
