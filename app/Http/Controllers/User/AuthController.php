<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('users.register');
    }

    public function register(Request $request)
{
    try {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:teacher,student',
        ]);

        if ($validator->fails()) {
            toastr()->warning('Please check your form and try again!');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        $data = $request->only(['name', 'email', 'role']);
        $data['password'] = Hash::make($request->password);
        $data['token'] = Str::random(50); // custom token field

        $user = User::create($data);

        $emailData = [
            'name' => $user->name,
            'token' => $user->token,
        ];

        Mail::to($user->email)->send(new WelcomeEmail($emailData));

        toastr()->success('Registration successful! Please check your email.');
        DB::commit();

        return redirect()->route('login.show')->with('success', 'Registered successfully! Please login.');
    } catch (Throwable $th) {
        DB::rollback();
        dd($th->getMessage());
    }
}
    public function showLoginForm()
{
    if (Auth::check()) {
        // Redirect based on role
        return Auth::user()->role === 'teacher'
            ? redirect()->route('users.index')
            : redirect()->route('users.students');
    }

    return view('users.login');
}

    // Login User
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();


        if (!Auth::User()->email_verified_at) {
                    toastr()->error('Please verify your email.');
                    Auth::logout();
                    return redirect()->route('login.show');
                }


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




    public function verification($token)
    {
        $tokenExists = User::where('verification_token', $token)->first();
        if ($tokenExists) {
            $tokenExists->update([
                'email_verified_at' => Carbon::now(),
                'verification_token' => null
            ]);
            toastr()->success('User verified Succesfully.');
        } else {
            toastr()->error('Invalid Token.');
        }
        return redirect()->route('login.show');
    }
}
