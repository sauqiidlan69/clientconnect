<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $role = request()->query('role');

        return match($role) {
            'admin' => view('auth.login_admin'),
            'support' => view('auth.login_support'),
            'customer' => view('auth.login_customer'),
            default => view('auth.login_admin'), // fallback
        };
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Redirect based on role
        $user = Auth::user();
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'support' => redirect()->route('support.dashboard.index'),
            default => redirect()->route('customer.dashboard.index'),
        };
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showAdminLogin(): View
    {
        return view('auth.login_admin');
    }

    public function showSupportLogin(): View
    {
        return view('auth.login_support');
    }

    public function showCustomerLogin(): View
    {
        return view('auth.login_customer');
    }
}
