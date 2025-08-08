<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => $validator->errors()->all(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $user = User::create($validatedData);
        $user["token"] = $user->createToken("ChatApp")->plainTextToken;

        return response()->json([
            "status" => 1,
            "message" => "User registered!",
            "data" => $user->except("password")
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => $validator->errors()->all(),
            ], 422);
        }

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                "status" => 1,
                "message" => "Login Successful!",
                "data" => $request->user(),
                "token" => $request->user()->createToken("MyApp")->plainTextToken,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Incorrect Credentials!",
                "data" => null
            ]);
        }
    }
}