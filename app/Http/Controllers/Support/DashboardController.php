<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get support user's ticket statistics
        $assignedTickets = Ticket::where('assigned_to', $user->id)->count();
        $openTickets = Ticket::where('assigned_to', $user->id)
                            ->where('status', 'open')
                            ->count();
        $inProgressTickets = Ticket::where('assigned_to', $user->id)
                                 ->where('status', 'in_progress')
                                 ->count();
        $closedTickets = Ticket::where('assigned_to', $user->id)
                             ->where('status', 'closed')
                             ->count();
        
        // Get recent assigned tickets
        $recentTickets = Ticket::where('assigned_to', $user->id)
                             ->with(['customer'])
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->get();
        
        // Get unread notifications
        $unreadNotifications = Notification::where('user_id', $user->id)
                                         ->where('is_read', false)
                                         ->orderBy('created_at', 'desc')
                                         ->limit(5)
                                         ->get();

        return view('dashboard.support.index', compact(
            'assignedTickets',
            'openTickets', 
            'inProgressTickets',
            'closedTickets',
            'recentTickets',
            'unreadNotifications'
        ));
    }
}
