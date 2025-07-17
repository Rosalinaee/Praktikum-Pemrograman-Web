<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    // Tampilkan form login untuk admin
    public function showAdminLogin()
    {
        return view('auth.login', ['role' => 'admin']);
    }

    // Tampilkan form login untuk user
    public function showUserLogin()
    {
        return view('auth.login', ['role' => 'user']);
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,user'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah role yang login sesuai dengan form login
            if ($user->role !== $request->input('role')) {
                Auth::logout();
                return back()->withErrors(['email' => 'Role tidak sesuai dengan akun.'])->withInput();
            }

            // Redirect sesuai role
            return redirect()->intended($user->role === 'admin' ? route('products.index') : route('katalog'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
