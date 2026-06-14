<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request) {
        $request->validated($request->all());

        if(Auth::attempt($request->only('email','password'))){
            //return $this->error('','Credentials do not match', 401);
            $user = User::where('email', $request->email)->first();

            $token =  $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
             ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
          ]);

    }

    public function logout(){

        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have successfully been logged out and your token has been deleted'
        ]);
    }
}
