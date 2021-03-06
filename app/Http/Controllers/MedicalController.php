<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Medical;
use App\Models\MedicalFee;
use App\Models\Clinic;
use App\Http\Resources\MedicalResource;
use Exception;

class MedicalController extends Controller
{
	public function index()
	{
		try {
			$medicals = Medical::with(['patient', 'user'])->get();
			if ($medicals->count() > 0) {
				return MedicalResource::collection($medicals);
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
			'registration_id' => 'required|exists:App\Models\Registration,id',
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'user_id' => 'required|exists:App\Models\User,id',
			'anamnesa' => 'required',
			'diagnosis' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$medical = new Medical();
				$medical->clinic_id = $request->clinic_id;
				$medical->registration_id = $request->registration_id;
				$medical->patient_id = $request->patient_id;
				$medical->user_id = $request->user_id;
				$medical->anamnesa = $request->anamnesa;
				$medical->diagnosis = $request->diagnosis;
				$medical->action = $request->action;
				$medical->total = $request->total;
				$medical->confirmed = false;

				$clinic = Clinic::find($request->clinic_id);

				DB::transaction(function () use ($medical, $clinic) {
					$medical->save();
					$clinic->increment('count_medical', 1);
					$count = Medical::find($medical->id);
					$count->number = $clinic->count_medical;
					$count->save();
				});

				return response()->json(['success' => true, 'data' => new MedicalResource($medical)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$medical = Medical::with(['clinic', 'registration', 'patient'])->find($id);
			if ($medical) {
				return new MedicalResource($medical);
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
			'user_id' => 'required|exists:App\Models\User,id',
			'anamnesa' => 'required',
			'diagnosis' => 'required',
			'total' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$medical = Medical::find($id);
				if ($medical) {
					$medical->anamnesa = $request->anamnesa;
					$medical->diagnosis = $request->diagnosis;
					$medical->action = $request->action;
					$medical->total = $request->total;

					DB::transaction(function () use ($medical) {
						$medical->save();
					});

					return response()->json(['success' => true, 'data' => new MedicalResource($medical)], 200);
				} else {
					return response()->json(['message' => 'Not Found'], 404);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function destroy($id)
	{
		try {
			$medical = Medical::find($id);
			if ($medical) {
				$medical->delete();
				return response()->json(['success' => true, 'data' => new MedicalResource($medical)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function fees(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required|exists:App\Models\Clinic,id',
			'medical_id' => 'required|exists:App\Models\Medical,id',
			'fee_id' => 'required|exists:App\Models\Fee,id'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$mf = new MedicalFee();
			$mf->clinic_id = $request->clinic_id;
			$mf->medical_id = $request->medical_id;
			$mf->fee_id = $request->fee_id;
			$mf->save();

			return response()->json(['success' => true, 'data' => $mf], 201);
		}
	}
}
