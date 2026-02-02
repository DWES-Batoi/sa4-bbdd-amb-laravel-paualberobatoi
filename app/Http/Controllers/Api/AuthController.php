<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised', ['error' => 'Credencials incorrectes'], 401);
        }

        $user = $request->user();
        $result = [
            'token' => $user->createToken('api')->plainTextToken,
            'name' => $user->name,
        ];

        return $this->sendResponse($result, 'User signed in', 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:6'],
            'confirm_password' => ['required','same:password'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors(), 422);
        }

        $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $result = [
            'token' => $user->createToken('api')->plainTextToken,
            'name' => $user->name,
        ];

        return $this->sendResponse($result, 'User created successfully', 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(['name' => $request->user()->name], 'User successfully signed out', 200);
    }
}
