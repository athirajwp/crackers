<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show admin login screen.
     */
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle login authentication.
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($request->password === $adminPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Invalid password! Default is admin123.']);
    }

    /**
     * Log out admin and terminate session.
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
