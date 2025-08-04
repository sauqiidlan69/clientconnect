<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $customerCount = Customer::count();
        $pendingTickets = Ticket::where('status', '!=', 'Closed')->count();
        $ticketCount = Ticket::count();
        $pendingAssignments = Ticket::where('status', 'Pending')->count();
        // Status chart data
        $statusLabels = Ticket::select('status')->distinct()->pluck('status')->toArray();
        $statusCounts = [];
        foreach ($statusLabels as $label) {
            $statusCounts[] = Ticket::where('status', $label)->count();
        }

        // Priority chart data
        $priorityLabels = Ticket::select('priority')->distinct()->pluck('priority')->toArray();
        $priorityCounts = [];
        foreach ($priorityLabels as $label) {
            $priorityCounts[] = Ticket::where('priority', $label)->count();
        }

        // Tickets created per month (last 6 months)
        $dateLabels = [];
        $createdCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M');
            $yearMonth = now()->subMonths($i)->format('Y-m');
            $dateLabels[] = $month;
            $createdCounts[] = Ticket::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$yearMonth])->count();
        }

        return view('dashboard.admin.index', compact(
            'userCount', 
            'customerCount',
            'pendingTickets',
            'ticketCount', 
            'pendingAssignments',
            'statusLabels',
            'statusCounts',
            'priorityLabels',
            'priorityCounts',
            'dateLabels',
            'createdCounts'
        ));
    }
}
