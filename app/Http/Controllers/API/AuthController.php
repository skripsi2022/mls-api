<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     return response()
        //         ->json(['message' => 'Unauthorized'], 401);
        // }

        // $user = User::where('email', $request['email'])->firstOrFail();

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()
        //     ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'success'   => false,
                'message' => 'These credentials do not match our records.',
                'status' => 500
            ], 401);
            // return response()->json(['message' => 'Salah pak :( !!!.'], 401);
        }
        // find siswa by ID user
        $siswa = Siswa::with('kelas')->where([
            ['user_id', '=', $user->id]
        ])->first();

        $token = $user->createToken('ApiToken')->plainTextToken;
        
        $response = [
            'success'   => true,    
            'user'      => $user,
            'siswa'     => $siswa,
            'role'      => $user->role,
            'token'     => $token,
            'status'     => 200,
        ];

        return response($response, 200);
    }

    // method for user logout and delete token
    public function logout()
    {
        // auth()->user()->tokens()->delete();

        //     return [
        //         'message' => 'You have successfully logged out and the token was successfully deleted'
        //     ];
        auth()->logout();
        
        return response()->json([
            'isok njrrr'    => true
        ], 200);
    }
}
