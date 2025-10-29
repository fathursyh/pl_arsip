<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // login
    public function loginPage() {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|string|email|max:100",
            "password" => "required|string:max:100",
            'remember' => 'sometimes|boolean'
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return match (auth()->user()->role) {
                'admin' => redirect()->intended(route('admin.home'))
                    ->with([
                        'alert' => 'Anda berhasil masuk akun!',
                        'type' => AlertEnum::SUCCESS->value,
                    ]),
                'user' => redirect()->intended(route('user.home'))
                    ->with([
                        'alert' => 'Anda berhasil masuk akun!',
                        'type' => AlertEnum::SUCCESS->value,
                    ]),
            };
        }
        $error = 'Email atau password salah.';
        return back()->withErrors([
            'email' => $error,
            'password' => $error,
            'error' => 'Proses masuk akun gagal!'
        ])->onlyInput('email');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->with([
            'alert' => 'Anda berhasil keluar akun!',
            'type'=> AlertEnum::INFO->value,
        ]);

    }
}
