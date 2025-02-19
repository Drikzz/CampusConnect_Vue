<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    /**
     * Handle an admin login request.
     */
    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Filter only admin users.
     */
    public function filterAdminUsers($username, $password)
    {
        $user = \DB::table('users')
            ->where('username', $username)
            ->where('is_admin', true)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
