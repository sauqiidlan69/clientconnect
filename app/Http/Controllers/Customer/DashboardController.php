<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get the customer record for this user and load tickets
        $customer = $user->customer;
        
        if ($customer) {
            // Count tickets for this customer
            $ticketCount = $customer->tickets()->count();
            
            // Get recent tickets
            $recentTickets = $customer->tickets()
                                   ->orderBy('created_at', 'desc')
                                   ->limit(5)
                                   ->get();
        } else {
            $ticketCount = 0;
            $recentTickets = collect();
        }
        
        $feedbackCount = 0; // You can implement this later if needed
        
        return view('dashboard.customer.index', compact('ticketCount', 'feedbackCount', 'recentTickets'));
    }
}
