<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
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
            return $this->responseError( $validator->errors()->first(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->responseError('Model not found.', 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->responseError('Invalid credentials', 404);
        }

        $data = [
            'user' => new UserResource($user),
            'token' => $user->createToken('User-Token')->plainTextToken,
        ];
        
        return $this->responseSuccess($data);

        return response()->json();
    }
}
