<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('users.register');
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:teacher,student',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.show')->with('success', 'Registered successfully! Please login.');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('users.login');
    }

    // Login User
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'teacher') {
            return redirect()->route('users.index')->with('success', 'Logged in as Teacher.');
        } else {
            return redirect()->route('users.students')->with('success', 'Logged in as Student.');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show')->with('success', 'Logged out successfully.');
    }
}
