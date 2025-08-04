<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TicketController;

Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard.index');

// Profile
Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Submit Feedback
Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Tickets (Customer-Created)
Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
