<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{
    PublicPageController,
    DashboardRedirectController,
    AdminDashboardController,
    AdminTicketController,
    AdminSupportController,
    AdminCustomerController,
    CustomerController,
    SupportTicketController,
    ProfileController,
    FeedbackController,
    InteractionController,
    NotificationController,
    ChartController,
    ReportController,
    TicketExportController
};

Route::get('/', [PublicPageController::class, 'index'])->name('home');

// Authentication Routes
// Custom login routes per role
Route::get('/login/admin', [AuthenticatedSessionController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/login/support', [AuthenticatedSessionController::class, 'showSupportLogin'])->name('login.support');
Route::get('/login/customer', [AuthenticatedSessionController::class, 'showCustomerLogin'])->name('login.customer');

// Optional: handle POST login for all roles (you may still use default)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Authenticated redirect after login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardRedirectController::class, 'redirect'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Feedback
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Interactions
    Route::post('/interactions', [InteractionController::class, 'store'])->name('interactions.store');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/csv', [TicketExportController::class, 'exportCSV'])->name('reports.csv');
    Route::get('/reports/export/pdf', [TicketExportController::class, 'exportPDF'])->name('reports.pdf');

    // Charts
    Route::get('/chart/tickets', [ChartController::class, 'ticketStats'])->name('chart.tickets');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin-specific ticket routes (if any additional beyond admin.php)
    Route::get('/tickets/{id}/assign', [AdminTicketController::class, 'assignForm'])->name('tickets.assign.form');
    Route::post('/tickets/{id}/assign', [AdminTicketController::class, 'assign'])->name('tickets.assign');
});

// Support Routes
Route::middleware(['auth', 'role:support'])->prefix('support')->name('support.')->group(function () {
    Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}', [SupportTicketController::class, 'update'])->name('tickets.update');
});

Route::middleware(['web', 'auth', 'role:admin'])->get('/test-role', function () {
    return 'Hello Admin!';
});
