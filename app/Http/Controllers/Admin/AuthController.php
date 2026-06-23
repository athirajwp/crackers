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
        $company = view()->shared('currentCompany');
        $companyCode = $company ? $company->code : 'default';

        // Clear existing session to force password authentication
        session()->forget('admin_logged_in_' . $companyCode);

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

        // Fetch admin password from DB or fallback to env/default
        $adminPassword = \App\Models\Setting::get('admin_password');
        if (!$adminPassword) {
            $adminPassword = env('ADMIN_PASSWORD', 'admin123');
        }

        // Check if the stored password is bcrypt hashed
        $isMatch = false;
        if (str_starts_with($adminPassword, '$2y$') || str_starts_with($adminPassword, '$2a$')) {
            $isMatch = \Illuminate\Support\Facades\Hash::check($request->password, $adminPassword);
        } else {
            $isMatch = ($request->password === $adminPassword);
        }

        if ($isMatch) {
            $company = view()->shared('currentCompany');
            $companyCode = $company ? $company->code : 'default';
            session(['admin_logged_in_' . $companyCode => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Invalid password!']);
    }

    /**
     * Log out admin and terminate session.
     */
    public function logout()
    {
        $company = view()->shared('currentCompany');
        $companyCode = $company ? $company->code : 'default';
        session()->forget('admin_logged_in_' . $companyCode);
        return redirect()->route('admin.login', ['company' => $companyCode]);
    }
}
