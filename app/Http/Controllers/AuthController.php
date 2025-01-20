<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {



        dd("check", $request->all());
        // Validasi form login 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Harap masukkan alamat email yang valid',
            'password.required' => 'Kata sandi wajib diisi',
        ]);

        try {
            $infoLogin = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            // Cek apakah email dan password benar
            if (!Auth::attempt($infoLogin)) {
                return redirect()->back()->withErrors(['error' => 'Email atau kata sandi salah!'])->withInput();
            }

            $user = Auth::user();

            return redirect()->route('dash');
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
