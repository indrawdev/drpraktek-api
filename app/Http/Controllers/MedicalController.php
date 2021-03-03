<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Medical;
use App\Models\MedicalFee;
use App\Http\Resources\MedicalResource;
use App\Mail\MedicalNotified;

class MedicalController extends Controller
{
	public function index()
	{
		$medicals = Medical::with(['patient', 'doctor'])->get();

		if ($medicals->count() > 0) {
			return MedicalResource::collection($medicals);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required|exists:App\Models\Clinic,id',
			'registration_id' => 'required|exists:App\Models\Registration,id',
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'doctor_id' => 'required|exists:App\Models\Doctor,id',
			'anamnesa' => 'required',
			'diagnosis' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$medical = new Medical();
			$medical->clinic_id = $request->clinic_id;
			$medical->registration_id = $request->registration_id;
			$medical->patient_id = $request->patient_id;
			$medical->doctor_id = $request->doctor_id;
			$medical->anamnesa = $request->anamnesa;
			$medical->diagnosis = $request->diagnosis;
			$medical->action = $request->action;
			$medical->total = $request->total;
			$medical->confirmed = 0;
			$medical->save();

			Mail::to('indra@ide.web.id')->later(now()->addSeconds(15), new MedicalNotified($medical));

			return response()->json(['success' => true, 'data' => $medical], 201);
		}
	}

	public function show($id)
	{
		$medical = Medical::with(['clinic', 'registration', 'doctor', 'patient'])->find($id);

		if ($medical) {
			return new MedicalResource($medical);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'doctor_id' => 'required|exists:App\Models\Doctor,id',
			'anamnesa' => 'required',
			'diagnosis' => 'required',
			'total' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$medical = Medical::find($id);

			if ($medical) {
				$medical->doctor_id = $request->doctor_id;
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
			return response()->json(['error' => 'Not found'], 404);
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
