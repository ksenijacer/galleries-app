<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{   

    public function login(Request $request)
     {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return [
            'token' => $token,
            'user' => Auth::user()
        ];
     }

    public function register(RegisterRequest $request)
     {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = Auth::login($user);

        return response()->json([
            'token' => $token,
            'user' => Auth::user(),
        ],200);
     }

    public function getMyProfile()
    {
        $activeUser = Auth::user();
        return response()->json($activeUser);
    }


    public function logout()
    {
        Auth::logout();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function refreshToken()
    {
        $token = Auth::refresh();
        return response()->json([
            'token' => $token
        ]);
    }
    public function unauthorizedRedirect()
    {
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    //  protected function respondWithToken($token)
    //  {
    //      return response()->json([
    //          'access_token' => $token,
    //          'token_type' => 'bearer',
    //          'expires_in' => auth()->factory()->getTTL() * 60
    //      ]);
    //  }
}
