<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Letter;
use App\Models\Clinic;
use App\Http\Resources\LetterResource;
use Exception;
use PDF;

class LetterController extends Controller
{
	public function index()
	{
		try {
			$letters = Letter::with(['user', 'patient'])->get();
			if ($letters->count() > 0) {
				return LetterResource::collection($letters);
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
			'user_id' => 'required|exists:App\Models\User,id',
			'patient_id' => 'required|exists:App\Models\Patient,id'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$letter = new Letter();
				$letter->uuid = Str::uuid();
				$letter->clinic_id = $request->clinic_id;
				$letter->user_id = $request->user_id;
				$letter->patient_id = $request->patient_id;
				$letter->start_at = $request->start_at;
				$letter->end_at = $request->end_at;

				$clinic = Clinic::find($request->clinic_id);

				DB::transaction(function () use ($letter, $clinic) {
					$letter->save();
					$clinic->increment('count_letter', 1);
					$count = Letter::find($letter->id);
					$count->number = $clinic->count_letter;
					$count->save();
				});

				return response()->json(['success' => true, 'data' => new LetterResource($letter)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$letter = Letter::with(['clinic', 'user', 'patient'])->find($id);
			if ($letter) {
				return new LetterResource($letter);
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
			'user_id' => 'required|exists:App\Models\User,id',
			'patient_id' => 'required|exists:App\Models\Patient,id'
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$letter = Letter::find($id);
				if ($letter) {
					$letter->user_id = $request->user_id;
					$letter->patient_id = $request->patient_id;
					$letter->start_at = $request->start_at;
					$letter->end_at = $request->end_at;
					$letter->save();
					return response()->json(['success' => true, 'data' => new LetterResource($letter)], 200);
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
			$letter = Letter::find($id);
			if ($letter) {
				$letter->delete();
				return response()->json(['success' => true, 'data' => $letter], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function referral($uuid)
	{
		$letter = Letter::where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.referral', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.referral');
			return $pdf->stream();
		}
	}

	public function health($uuid)
	{
		$letter = Letter::with(['patient', 'user'])->where('uuid', $uuid)->first();

		if ($letter) {
			$pdf = PDF::loadView('prints.letters.health', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.health');
			return $pdf->stream();
		}
	}

	public function sick($uuid)
	{
		$letter = Letter::with(['patient', 'user'])->where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.sick', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.sick');
			return $pdf->stream();
		}
	}

	public function pregnant($uuid)
	{
		$letter = Letter::with(['patient', 'user'])->where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.pregnant', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.pregnant');
			return $pdf->stream();
		}
	}

	public function informedconcent($uuid)
	{
		$letter = Letter::with(['patient', 'user'])->where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.informedconcent', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.informedconcent');
			return $pdf->stream();
		}
	}
}
