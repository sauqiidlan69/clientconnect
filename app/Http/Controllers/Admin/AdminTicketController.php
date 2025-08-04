<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['customer', 'assignedUser'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);
        
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'assignedUser']);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function create()
    {
        $customers = Customer::all();
        $supportUsers = User::where('role', 'support')->get();
        
        return view('admin.tickets.create', compact('customers', 'supportUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:open,in_progress,pending,closed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket = Ticket::create($request->all());

        // Notify assigned support user if ticket is assigned
        if ($request->assigned_to) {
            $this->createNotification(
                $request->assigned_to,
                'Ticket Assigned',
                "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
                'assignment'
            );
        }

        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket created successfully!');
    }

    public function edit(Ticket $ticket)
    {
        $customers = Customer::all();
        $supportUsers = User::where('role', 'support')->get();
        
        return view('admin.tickets.edit', compact('ticket', 'customers', 'supportUsers'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:open,in_progress,pending,closed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $oldAssignedTo = $ticket->assigned_to;
        $ticket->update($request->all());

        // Notify if assignment changed
        if ($oldAssignedTo != $request->assigned_to && $request->assigned_to) {
            $this->createNotification(
                $request->assigned_to,
                'Ticket Reassigned',
                "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
                'assignment'
            );
        }

        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        
        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket deleted successfully!');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $supportUser = User::findOrFail($request->assigned_to);
        
        if (!$supportUser->isSupport()) {
            return back()->withErrors(['assigned_to' => 'Can only assign tickets to support users.']);
        }

        $ticket->update(['assigned_to' => $request->assigned_to]);

        // Create notification for assigned support user
        $this->createNotification(
            $request->assigned_to,
            'New Ticket Assignment',
            "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
            'assignment'
        );

        return back()->with('success', 'Ticket assigned successfully!');
    }

    public function unassign(Ticket $ticket)
    {
        $ticket->update(['assigned_to' => null]);
        
        return back()->with('success', 'Ticket unassigned successfully!');
    }

    private function createNotification($userId, $title, $message, $type = 'info')
    {
        Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false,
        ]);
    }
}
