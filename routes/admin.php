<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminSupportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TicketExportController;

// Tickets Management (Full CRUD)
Route::resource('tickets', AdminTicketController::class);
Route::patch('tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])->name('tickets.assign');
Route::patch('tickets/{ticket}/unassign', [AdminTicketController::class, 'unassign'])->name('tickets.unassign');

// Customers Management (CRUD)
Route::resource('customers', AdminCustomerController::class);

// Support Management (CRUD)
Route::resource('support', AdminSupportController::class);

// Reports
Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('reports/customers', [ReportController::class, 'generateCustomerReport'])->name('reports.customers');
Route::post('reports/tickets', [ReportController::class, 'generateTicketReport'])->name('reports.tickets');

// Notifications
Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
