<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $user = Customer::where('email', $request->email)->first();

        if ($user) {
            return json_encode([
                'error' => 'user is exists', 'status' => 'error'
            ]);
        } else {

            $token = Str::random(60);
            $user =  Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_name'=>$request->user_name,
                'password' => Hash::make($request->password),
                'api_token' => hash('sha256', $token),
            ]);
            if($user){
                return json_encode([
                    'message' => 'Register Successfully', 'status' => 'success'
                ]);
            }else{
                return json_encode([
                    'error' => 'something is wrong', 'status' => 'error'
                ]);
            }

        }
    }
}
