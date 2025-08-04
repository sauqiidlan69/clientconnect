<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('assigned_to', Auth::id())
                         ->with(['customer'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);
        
        return view('support.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        // Ensure support user can only see their assigned tickets
        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        $ticket->load(['customer']);
        return view('support.tickets.show', compact('ticket'));
    }

    public function accept(Ticket $ticket)
    {
        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $ticket->update(['status' => 'in_progress']);

        // Notify admin about acceptance
        $this->notifyAdmins(
            'Ticket Accepted',
            "Support user " . Auth::user()->name . " has accepted ticket #{$ticket->id}: {$ticket->title}",
            'acceptance'
        );

        return back()->with('success', 'Ticket accepted and status updated to In Progress!');
    }

    public function reject(Request $request, Ticket $ticket)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $ticket->update([
            'assigned_to' => null,
            'status' => 'open',
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Notify admin about rejection
        $this->notifyAdmins(
            'Ticket Rejected',
            "Support user " . Auth::user()->name . " has rejected ticket #{$ticket->id}: {$ticket->title}. Reason: {$request->rejection_reason}",
            'rejection'
        );

        return redirect()->route('support.tickets.index')
                        ->with('success', 'Ticket rejected and returned to unassigned pool.');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:in_progress,closed,on_hold',
            'status_note' => 'nullable|string|max:500',
        ]);

        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $oldStatus = $ticket->status;
        $ticket->update([
            'status' => $request->status,
            'status_note' => $request->status_note,
        ]);

        // Notify admin about status change
        $this->notifyAdmins(
            'Ticket Status Updated',
            "Ticket #{$ticket->id} status changed from {$oldStatus} to {$request->status} by " . Auth::user()->name,
            'status_update'
        );

        return back()->with('success', 'Ticket status updated successfully!');
    }

    private function notifyAdmins($title, $message, $type = 'info')
    {
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'is_read' => false,
            ]);
        }
    }
}
