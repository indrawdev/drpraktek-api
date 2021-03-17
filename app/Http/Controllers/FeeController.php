<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Fee;
use App\Models\Clinic;
use App\Http\Resources\FeeResource;

class FeeController extends Controller
{
	public function index()
	{
		$fees = Fee::all();

		if ($fees->count() > 0) {
			return FeeResource::collection($fees);
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
			$fee = new Fee();
			$fee->clinic_id = $request->clinic_id;
			$fee->name = $request->name;
			$fee->price = $request->price;

			DB::transaction(function () use ($fee) {
				$fee->save();
			});

			return response()->json(['success' => true, 'data' => $fee], 201);
		}
	}

	public function show($id)
	{
		$fee = Fee::with('clinic')->find($id);
		
		if ($fee) {
			return new FeeResource($fee);
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
			$fee = Fee::find($id);

			if ($fee) {
				return response()->json(['success' => true, 'data' => $fee], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$fee = Fee::find($id);

		if ($fee) {
			$fee->delete();
			return response()->json(['success' => true, 'data' => $fee], 200);
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
