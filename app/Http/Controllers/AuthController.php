<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
		$key = Str::lower($request->input('email')).'|'.$request->ip();

    	if (RateLimiter::tooManyAttempts($key, 5)) {
    	    $seconds = RateLimiter::availableIn($key);
    	    throw ValidationException::withMessages([
    	        'email' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik.",
    	    ]);
    	}
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Selamat datang HRD!');
        }

		RateLimiter::hit($key,30);
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda sudah logout.');
    }
}
