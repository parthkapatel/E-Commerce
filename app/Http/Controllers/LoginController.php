<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){


        $data = $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $user = Customer::where('user_name', $request->user_name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return json_encode([
                "status"=>"error",
                'message' => 'These credentials do not match our records.'
            ]);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
