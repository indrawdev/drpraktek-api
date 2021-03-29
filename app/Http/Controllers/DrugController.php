<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Drug;
use App\Http\Resources\DrugResource;
use Exception;

class DrugController extends Controller
{
	public function index()
	{
		try {
			$drugs = Drug::all();
			if ($drugs->count() > 0) {
				return DrugResource::collection($drugs);
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
			'name' => 'required',
			'price' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$drug = new Drug();
				$drug->clinic_id = $request->clinic_id;
				$drug->sku = $request->sku;
				$drug->name = $request->name;
				$drug->price = $request->price;

				DB::transaction(function () use ($drug) {
					$drug->save();
				});

				return response()->json(['success' => true, 'data' => new DrugResource($drug)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$drug = Drug::with('clinic')->find($id);
			if ($drug) {
				return new DrugResource($drug);
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
			'name' => 'required',
			'price' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$drug = Drug::with('clinic')->find($id);
				if ($drug) {
					return response()->json(['success' => true, 'data' => new DrugResource($drug)], 200);
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
			$drug = Drug::find($id);
			if ($drug) {
				$drug->delete();
				return response()->json(['success' => true, 'data' => new DrugResource($drug)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}
