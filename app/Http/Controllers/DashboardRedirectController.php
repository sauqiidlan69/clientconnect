<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function redirect()
    {
        $role = Auth::user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'support' => redirect()->route('support.dashboard.index'),
            'customer' => redirect()->route('customer.dashboard.index'),
            default => redirect('/'),
        };
    }
}
