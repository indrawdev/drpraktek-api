<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use App\Models\Clinic;
use App\Http\Resources\RegistrationResource;

class RegistrationController extends Controller
{
	public function index()
	{
		$registrations = Registration::with(['patient', 'user'])->get();
		
		if ($registrations->count() > 0) {
			return RegistrationResource::collection($registrations);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required|exists:App\Models\Clinic,id',
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'user_id' => 'required|exists:App\Models\User,id',
			'registered_at' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$registration = new Registration();
			$registration->clinic_id = $request->clinic_id;
			$registration->patient_id = $request->patient_id;
			$registration->user_id = $request->user_id;
			$registration->registered_at = $request->registered_at;

			DB::transaction(function () use ($registration, $request) {
				$registration->number = $this->generateNumber($request->clinic_id);
				$registration->save();
			});

			return response()->json(['success' => true, 'data' => $registration], 201);
		}
	}

	public function show($id)
	{
		$registration = Registration::with(['clinic', 'patient', 'user'])->find($id);
		
		if ($registration) {
			return new RegistrationResource($registration);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'user_id' => 'required|exists:App\Models\User,id',
			'number' => 'required',
			'registered_at' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$registration = Registration::find($id);

			if ($registration) {
				$registration->patient_id = $request->patient_id;
				$registration->user_id = $request->user_id;
				$registration->number = $request->number;
				$registration->registered_at = $request->registered_at;

				DB::transaction(function () use ($registration) {
					$registration->save();
				});
		
				return response()->json(['success' => true, 'data' => $registration], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
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
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	private function generateNumber($id)
	{
		$clinic = Clinic::find($id);
		$clinic->increment('count_registration', 1);
		return $clinic->count_registration;
	}
}
