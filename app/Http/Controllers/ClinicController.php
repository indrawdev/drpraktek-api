<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clinic;

class ClinicController extends Controller
{
	public function index()
	{
		$clinics = Clinic::all();

		if ($clinics->count() > 0) {
			return response()->json(['data' => $clinics], 200);
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
			$clinic = new Clinic();
			$clinic->name = $request->name;
			$clinic->save();

			return response()->json(['success' => true, 'data' => $clinic], 201);
		}
	}

	public function show($id)
	{
		$clinic = Clinic::findOrFail($id);

		if ($clinic->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			return response()->json(['data' => $clinic], 200);
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
			$clinic = Clinic::findOrFail($id);
			$clinic->name = $request->name;
			$clinic->save();

			return response()->json(['success' => true, 'data' => $clinic], 200);
		}
	}

	public function destroy($id)
	{
		$clinic = Clinic::findOrFail($id);

		if ($clinic->isEmpty()) {
			return response()->json(['message' => 'Not Found'], 404);
		} else {
			$clinic->delete();
			return response()->json(['success' => true, 'data' => $clinic], 200);
		}
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
