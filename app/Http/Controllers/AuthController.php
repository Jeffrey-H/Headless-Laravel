<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends
    Controller {
    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), ['name' => 'required|string', 'email' => 'required|string|email|unique:users', 'password' => 'required|string|confirmed']);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json(['status' => 200, 'message' => 'Successfully created user!'], 201);
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse [string] access_token
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), ['email' => 'required|string|email', 'password' => 'required|string', 'remember_me' => 'boolean']);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json(['status' => '401', 'message' => 'Unauthorized'], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();
        return response()->json([
            'status' => 200,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['status' => 200, 'message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated User
     *
     * @param Request $request
     * @return JsonResponse [json] user object
     */
    public function user(Request $request) {
        return response()->json(['status' => 200, 'data' => $request->user()]);
    }
}
