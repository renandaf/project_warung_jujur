<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function register(Request $request){
       return User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);
    }
}

