<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => "pelanggan",
            'gambar' => "default.png",
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day
        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        // 1 day
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/user', $gambar->hashName());
            if ($request->has('password')) {
                $user->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'gambar' => $gambar->hashName(),
                    'password' => Hash::make($request->input('password')),
                ]);
            } else {
                $user->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'gambar' => $gambar->hashName(),
                ]);
            }
        } else {
            if ($request->has('password')) {
                $user->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->input('password')),
                ]);
            } else {
                $user->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                ]);
            }
        }
        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
