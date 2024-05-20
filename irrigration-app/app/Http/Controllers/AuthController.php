<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email )->first();

        if(!$user || ! Hash::check($request->password, $user->password))
        {
            return response()->json([
                'error' => 'The provided credentials are incorrect'
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $device = substr($request->userAgent() ?? '', 0, 255);
            $token = auth()->user()->createToken($device)->plainTextToken;
            return response()->json(['accessToken' => $token], 200);
        }
        
        return response()->json(['message' => 'Unauthorized'], 401);  
        
    }
}
