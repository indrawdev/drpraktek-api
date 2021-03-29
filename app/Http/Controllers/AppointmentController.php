<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Http\Resources\AppointmentResource;
use Exception;

class AppointmentController extends Controller
{
	public function index()
	{
		try {
			$appointments = Appointment::all();
			if ($appointments->count() > 0) {
				return AppointmentResource::collection($appointments);
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
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'user_id' => 'required|exists:App\Models\User,id',
			'appointment_at' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$appointment = new Appointment();
				$appointment->clinic_id = $request->clinic_id;
				$appointment->patient_id = $request->patient_id;
				$appointment->user_id = $request->user_id;
				$appointment->appointment_at = $request->appointment_at;

				DB::transaction(function () use ($appointment) {
					$appointment->save();
				});

				return response()->json(['success' => true, 'data' => new AppointmentResource($appointment)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$appointment = Appointment::find($id);
			if ($appointment) {
				return new AppointmentResource($appointment);
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
			'patient_id' => 'required|exists:App\Models\Patient,id',
			'user_id' => 'required|exists:App\Models\User,id',
			'appointment_at' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$appointment = Appointment::find($id);
				if ($appointment) {
					$appointment->patient_id = $request->patient_id;
					$appointment->user_id = $request->user_id;
					$appointment->appointment_at = $request->appointment_at;

					DB::transaction(function () use ($appointment) {
						$appointment->save();
					});

					return response()->json(['success' => true, 'data' => new AppointmentResource($appointment)], 200);
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
			$appointment = Appointment::find($id);
			if ($appointment) {
				DB::transaction(function () use ($appointment) {
					$appointment->delete();
				});
				return response()->json(['success' => true, 'data' => new AppointmentResource($appointment)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}
