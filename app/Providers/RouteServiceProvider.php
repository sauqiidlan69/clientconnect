<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register the middleware alias manually!

        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::middleware(['web', 'auth', 'role:admin'])
            ->prefix('admin')
            ->as('dashboard.admin.')
            ->group(base_path('routes/admin.php'));

        Route::middleware(['web', 'auth', 'role:support'])
            ->prefix('support')
            ->as('dashboard.support.')
            ->group(base_path('routes/support.php'));

        Route::middleware(['web', 'auth', 'role:customer'])
            ->prefix('customer')
            ->as('dashboard.customer.')
            ->group(base_path('routes/customer.php'));
    }
}
