<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use App\Http\Resources\RegistrationResource;

class RegistrationController extends Controller
{
	public function index()
	{
		$registrations = Registration::with(['patient', 'officer'])->get();
		
		if ($registrations->count() > 0) {
			return RegistrationResource::collection($registrations);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required',
			'patient_id' => 'required',
			'officer_id' => 'required',
			'number' => 'required',
			'registered_at' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$registration = new Registration();
			$registration->clinic_id = $request->clinic_id;
			$registration->patient_id = $request->patient_id;
			$registration->officer_id = $request->officer_id;
			$registration->number = $request->number;
			$registration->registered_at = $request->registered_at;
			$registration->save();

			return response()->json(['success' => true, 'data' => $registration], 201);
		}
	}

	public function show($id)
	{
		$registration = Registration::with(['clinic', 'patient', 'officer'])->find($id);
		
		if ($registration) {
			return new RegistrationResource($registration);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'patient_id' => 'required',
			'number' => 'required',
			'registered_at' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$registration = Registration::find($id);

			if ($registration) {
				$registration->patient_id = $request->patient_id;
				$registration->officer_id = $request->officer_id;
				$registration->number = $request->number;
				$registration->registered_at = $request->registered_at;
				$registration->save();
		
				return response()->json(['success' => true, 'data' => $registration], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$registration = Registration::find($id);

		if ($registration) {
			$registration->delete();
			return response()->json(['success' => true, 'data' => $registration], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
}
