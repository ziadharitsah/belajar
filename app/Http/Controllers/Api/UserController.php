<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){

        $validator =  Validator::make($request->all(),[
            'name'      => 'required|string|min:3|max:155',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'created',
            'user'  => $user
        ]);
    }
}
