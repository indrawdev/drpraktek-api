<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
	public function index()
	{
		$appointments = Appointment::all();

		if ($appointments->count() > 0) {
			return AppointmentResource::collection($appointments);
		} else {
			return response()->json(['message' => 'Not Found'], 400);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required',
			'patient_id' => 'required',
			'officer_id' => 'required',
			'appointment_at' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$appointment = new Appointment();
			$appointment->clinic_id = $request->clinic_id;
			$appointment->patient_id = $request->patient_id;
			$appointment->officer_id = $request->officer_id;
			$appointment->appointment_at = $request->appointment_at;
			$appointment->save();

			return response()->json(['success' => true, 'data' => $appointment], 200);
		}
	}

	public function show($id)
	{
		$appointment = Appointment::find($id);
		
		if ($appointment) {
			return new AppointmentResource($appointment);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'patient_id' => 'required',
			'officer_id' => 'required',
			'appointment_at' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$appointment = Appointment::find($id);

			if ($appointment) {
				$appointment->patient_id = $request->patient_id;
				$appointment->officer_id = $request->officer_id;
				$appointment->appointment_at = $request->appointment_at;
				$appointment->save();
				return response()->json(['success' => true, 'data' => $appointment], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$appointment = Appointment::find($id);

		if ($appointment) {
			$appointment->delete();
			return response()->json(['success' => true, 'data' => $appointment], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
}
