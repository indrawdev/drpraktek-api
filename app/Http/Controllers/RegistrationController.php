<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;

class RegistrationController extends Controller
{
	public function index()
	{
		$registrations = Registration::all();
		
		if ($registrations->count() > 0) {
			return response()->json(['data' => $registrations], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$registration = new Registration();
			$registration->name = $request->name;
			$registration->save();

			return response()->json(['success' => true, 'data' => $registration], 201);
		}
	}

	public function show($id)
	{
		$registration = Registration::find($id);
		
		if ($registration) {
			return response()->json($registration, 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
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
			$registration = Registration::find($id);

			if ($registration) {
				$registration->name = $request->name;
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
