<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Support\DashboardController as SupportDashboardController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\NotificationController;

Route::get('/dashboard', [SupportDashboardController::class, 'index'])->name('dashboard.index');

// View Assigned Tickets
Route::get('tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
Route::get('tickets/assigned', [SupportTicketController::class, 'assigned'])->name('tickets.assigned');
Route::get('tickets/rejected', [SupportTicketController::class, 'rejected'])->name('tickets.rejected');
Route::get('tickets/history', [SupportTicketController::class, 'history'])->name('tickets.history');
Route::get('tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');

// Ticket Actions
Route::patch('tickets/{ticket}/accept', [SupportTicketController::class, 'accept'])->name('tickets.accept');
Route::patch('tickets/{ticket}/reject', [SupportTicketController::class, 'reject'])->name('tickets.reject');
Route::patch('tickets/{ticket}/status', [SupportTicketController::class, 'updateStatus'])->name('tickets.status');

// Interaction Logs
Route::post('tickets/{ticket}/interactions', [InteractionController::class, 'store'])->name('tickets.interactions.store');

// Notifications
Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
