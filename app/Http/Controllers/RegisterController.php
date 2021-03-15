<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Register;
use App\Http\Resources\RegisterResource;
use App\Mail\RegisterApproved;
use App\Mail\RegisterRejected;

class RegisterController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:sanctum', ['except' => ['store']]);
	}

	public function index()
	{
		$registers = Register::with('user')->get();

		if ($registers->count() > 0) {
			return RegisterResource::collection($registers);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'clinic' => 'required|string',
			'address' => 'required|string',
			'email' => 'required|email',
			'phone' => 'required|string',
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$register = new Register();
			$register->name = $request->name;
			$register->clinic = $request->clinic;
			$register->address = $request->address;
			$register->email = $request->email;
			$register->phone = $request->phone;
			$register->save();

			return response()->json(['success' => true, 'data' => $register], 201);
		}
	}

	public function show($id)
	{
		$register = Register::find($id);

		if ($register) {
			return new RegisterResource($register);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'clinic' => 'required|string',
			'address' => 'required|string',
			'email' => 'required|email',
			'phone' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$register = Register::find($id);

			if ($register) {
				$register->name = $request->name;
				$register->clinic = $request->clinic;
				$register->address = $request->address;
				$register->email = $request->email;
				$register->phone = $request->phone;
				$register->save();

				return response()->json(['success' => true, 'data' => $register], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$register = Register::find($id);

		if ($register) {
			$register->delete();
			return response()->json(['success' => true, 'data' => $register], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function accepted(Request $request)
	{
		$register = Register::find($request->register_id);

		if ($register) {
			Mail::to($register->email)->send(new RegisterApproved($register));
			return response()->json(['success' => true, 'data' => $register], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}

	public function rejected(Request $request)
	{
		$register = Register::find($request->register_id);

		if ($register) {
			$register->delete();
			Mail::to($register->email)->send(new RegisterRejected($register));
			return response()->json(['success' => true, 'data' => $register], 200);
		} else {
			return response()->json(['error' => 'Not found'], 404);
		}
	}
}
