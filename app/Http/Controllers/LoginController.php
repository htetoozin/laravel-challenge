<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'min:6'],
            'password' => ['required', 'min:8']
        ], [
            'required' => ':attribute is required.',
            'min'      => ':attribute is invalid.'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 422,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Model not found.',
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid credentials',
            ], 404);
        }

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('User-Token')->plainTextToken,
        ]);
    }
}
