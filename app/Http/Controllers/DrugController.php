<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Drug;
use App\Models\Clinic;
use App\Http\Resources\DrugResource;

class DrugController extends Controller
{
	public function index()
	{
		$drugs = Drug::all();

		if ($drugs->count() > 0) {
			return DrugResource::collection($drugs);
		} else {
			return response()->json(['error' => 'Not found'], 404);
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
			$drug = new Drug();
			$drug->clinic_id = $request->clinic_id;
			$drug->sku = $request->sku;
			$drug->name = $request->name;
			$drug->price = $request->price;

			DB::transaction(function () use ($drug) {
				$drug->save();
			});

			return response()->json(['success' => true, 'data' => new DrugResource($drug)], 201);
		}
	}

	public function show($id)
	{
		$drug = Drug::with('clinic')->find($id);
		
		if ($drug) {
			return new DrugResource($drug);
		} else {
			return response()->json(['error' => 'Not found'], 404);
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
			$drug = Drug::with('clinic')->find($id);

			if ($drug) {
				return response()->json(['success' => true, 'data' => new DrugResource($drug)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$drug = Drug::find($id);

		if ($drug) {
			$drug->delete();
			return response()->json(['success' => true, 'data' => $drug], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	private function generateNumber($id)
	{
		$clinic = Clinic::find($id);
		$clinic->increment('count_letter', 1);
		return $clinic->count_letter;
	}
}
