<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Officer;
use App\Http\Resources\OfficerResource;

class OfficerController extends Controller
{
	public function index()
	{
		$officers = Officer::all();

		if ($officers->count() > 0) {
			return OfficerResource::collection($officers);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required|exists:App\Models\Clinic,id',
			'name' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$officer = new Officer();
			$officer->clinic_id = $request->clinic_id;
			$officer->name = $request->name;
			$officer->save();

			return response()->json(['success' => true, 'data' => $officer], 201);
		}
	}

	public function show($id)
	{
		$officer = Officer::with('clinic')->find($id);
		
		if ($officer) {
			return new OfficerResource($officer);
		} else {
			return response()->json(['error' => 'Not found'], 404);
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
			$officer = Officer::find($id);

			if ($officer) {
				$officer->name = $request->name;
				$officer->save();
				return response()->json(['success' => true, 'data' => $officer], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$officer = Officer::find($id);

		if ($officer) {
			$officer->delete();
			return response()->json(['success' => true, 'data' => $officer], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}
}
