<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /* ---------- VIEWS ------------ */
    public function loginPage() {
        return view('auth.login');
    }

    /* ---------- LOGIC ------------ */
    //* login
    public function login(Request $request)
    {
        $request->validate([
            "nip" => "required|string|max:20", // NIP replaced Email
            "password" => "required|string|max:100",
            'remember' => 'sometimes|boolean'
        ], [
            'nip.required' => 'NIP tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        $credentials = $request->only('nip', 'password');

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
                default => redirect()->route('login')->withErrors(['error' => 'Role akun tidak dikenali.']),
            };
        }

        $error = 'NIP atau password salah.';

        return back()->withErrors([
            'nip' => $error,
            'password' => $error,
            'error' => 'Proses masuk akun gagal!'
        ])->onlyInput('nip');
    }

    //* logout
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
