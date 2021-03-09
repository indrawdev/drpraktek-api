<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clinic;
use App\Http\Resources\ClinicResource;

class ClinicController extends Controller
{
	public function index()
	{
		$clinics = Clinic::with('user')->get();

		if ($clinics->count() > 0) {
			return ClinicResource::collection($clinics);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'name' => 'required',
			'address' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$clinic = new Clinic();
			$clinic->email = $request->email;
			$clinic->name = $request->name;
			$clinic->slug = $request->name;
			$clinic->address = $request->address;
			$clinic->phone = $request->phone;
			$clinic->save();

			return response()->json(['success' => true, 'data' => $clinic], 201);
		}
	}

	public function show($id)
	{
		$clinic = Clinic::with(['user', 'doctors', 'patients', 'officers'])->find($id);

		if ($clinic) {
			return new ClinicResource($clinic);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'address' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$clinic = Clinic::find($id);

			if ($clinic) {
				$clinic->name = $request->name;
				$clinic->slug = $request->name;
				$clinic->address = $request->address;
				$clinic->phone = $request->phone;
				$clinic->email = $request->email;
				$clinic->save();

				return response()->json(['success' => true, 'data' => $clinic], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$clinic = Clinic::find($id);

		if ($clinic) {
			$clinic->delete();
			return response()->json(['success' => true, 'data' => $clinic], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
