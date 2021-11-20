<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum')->only(['profile', 'signOut']);
    }

    /**
     * Create an account.
     *
     */
    public function signUp(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => $attr['password'],
            'email' => $attr['email']
        ]);

        return response()->json([
            'token' => $user->createToken('munaf')->plainTextToken
        ], 201);

    }

    /**
     * Login a user by credentials.
     *
     */
    public function signIn(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Failed to login! check out your credentials.', 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('munaf')->plainTextToken
        ], 200);
    }

    /**
     * Get a user's logged in profile.
     *
     */
    public function profile()
    {
        return response()->json([
            'user' => new UserResource(auth()->user())
        ], 200);
    }


    /**
     * Sign out (logout).
     *
     */
    public function signOut()
    {
        try {
            $user = Auth::user();
            // Revoke current user token
            $user
                ->tokens()
                ->where("id", $user->currentAccessToken()->id)
                ->delete();

            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
