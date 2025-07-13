<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request)
    {
        // Validation has already passed!
        $validated = $request->validated();
        $storedUser = User::register($validated);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->has('remember'); // true if checkbox is checked

        if (Auth::attempt($credentials, $remember)) {
            session(['remember_checked' => true]);
            session(['remember_email' => $request->email]);

            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Before invalidate
        $email = session('remember_email');
        $checked = session('remember_checked');

        Auth::logout();

        $request->session()->invalidate(); // Clear session data
        $request->session()->regenerateToken(); // Prevent CSRF reuse

        // Re-store email/checkbox
        session(['remember_email' => $email]);
        session(['remember_checked' => $checked]);

        return redirect('/login')->with('status', 'You have been logged out.');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $updated = User::updatePasswordByEmail($request->email, $request->password);

        if ($updated) {
            return redirect()->route('login')->with('status', 'Password updated successfully.');
        }

        return back()->withErrors(['email' => 'Failed to reset password. Try again.']);
    }
}
