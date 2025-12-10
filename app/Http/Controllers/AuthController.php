<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Logs;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'approver',
        ]);

        Auth::login($user);

        Logs::create([
            'user_id' => $user->id,
            'action'  => 'REGISTER',
            'description' => 'User baru mendaftar dan login otomatis',
            'subject_id' => $user->id
        ]);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    // ================= LOGIN =================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Logs::create([
                'user_id' => Auth::id(),
                'action'  => 'LOGIN',
                'description' => 'User berhasil login',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ================= LOGOUT =================

    public function logout(Request $request)
    {
        $userId = Auth::id();

        if ($userId) {
            Logs::create([
                'user_id' => $userId,
                'action'  => 'LOGOUT',
                'description' => 'User melakukan logout',
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
