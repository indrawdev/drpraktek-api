<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;

class PatientController extends Controller
{
	public function index()
	{
		$patients = Patient::all();
		
		if ($patients->count() > 0) {
			return response()->json(['data' => $patients], 200);
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
			$patient = new Patient();
			$patient->name = $request->name;
			$patient->save();

			return response()->json(['success' => true, 'data' => $patient], 201);
		}
	}

	public function show($id)
	{
		$patient = Patient::findOrFail($id);
		
		if ($patient->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $patient], 200);
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
			$patient = Patient::findOrFail($id);
			$patient->name = $request->name;
			$patient->save();
	
			return response()->json(['success' => true, 'data' => $patient], 200);
		}
	}

	public function destroy($id)
	{
		$patient = Patient::findOrFail($id);

		if ($patient->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$patient->delete();
			return response()->json(['success' => true, 'data' => $patient], 200);
		}
	}
}
