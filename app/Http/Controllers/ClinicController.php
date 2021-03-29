<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Clinic;
use App\Http\Resources\ClinicResource;
use Exception;

class ClinicController extends Controller
{
	public function index()
	{
		try {
			$clinics = Clinic::with('users')->get();
			if ($clinics->count() > 0) {
				return ClinicResource::collection($clinics);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		} catch (Exception $e) {
			return $e;
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

			try {
				$clinic = new Clinic();
				$clinic->uuid = Str::uuid();
				$clinic->email = $request->email;
				$clinic->name = $request->name;
				$clinic->slug = $request->name;
				$clinic->address = $request->address;
				$clinic->phone = $request->phone;

				DB::transaction(function () use ($clinic) {
					$clinic->save();
				});

				return response()->json(['success' => true, 'data' => new ClinicResource($clinic)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$clinic = Clinic::with(['users', 'patients'])->find($id);
			if ($clinic) {
				return new ClinicResource($clinic);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		} catch (Exception $e) {
			return $e;
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

			try {
				$clinic = Clinic::find($id);
				if ($clinic) {
					$clinic->name = $request->name;
					$clinic->slug = $request->name;
					$clinic->address = $request->address;
					$clinic->phone = $request->phone;
					$clinic->email = $request->email;

					DB::transaction(function () use ($clinic) {
						$clinic->save();
					});

					return response()->json(['success' => true, 'data' => new ClinicResource($clinic)], 200);
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
			$clinic = Clinic::find($id);
			if ($clinic) {
				$clinic->delete();
				return response()->json(['success' => true, 'data' => new ClinicResource($clinic)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}