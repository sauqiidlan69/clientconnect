<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $tickets = Ticket::with(['customer', 'assignedUser'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());
            
        return view('admin.tickets.index', compact('tickets', 'search'));
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
            'status' => 'required|in:open,in_progress,closed,on_hold',
            'assigned_to' => 'nullable|exists:users,id',
            'status_note' => 'nullable|string'
        ]);

        $ticket = Ticket::create($request->all());

        // If assigned, create notification
        if ($request->assigned_to) {
            Notification::create([
                'user_id' => $request->assigned_to,
                'type' => 'ticket_assigned',
                'title' => 'New Ticket Assigned',
                'message' => "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
                'is_read' => false,
            ]);
        }

        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'assignedUser']);
        return view('admin.tickets.show', compact('ticket'));
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
            'status' => 'required|in:open,in_progress,closed,on_hold',
            'assigned_to' => 'nullable|exists:users,id',
            'status_note' => 'nullable|string',
            'rejection_reason' => 'nullable|string'
        ]);

        $oldAssignedTo = $ticket->assigned_to;
        $ticket->update($request->all());

        // If assignment changed, create notification
        if ($request->assigned_to && $request->assigned_to != $oldAssignedTo) {
            Notification::create([
                'user_id' => $request->assigned_to,
                'type' => 'ticket_assigned',
                'title' => 'Ticket Assigned',
                'message' => "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
                'is_read' => false,
            ]);
        }

        return redirect()->route('admin.tickets.show', $ticket)
                        ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket deleted successfully.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in_progress'
        ]);

        // Create notification for assigned user
        Notification::create([
            'user_id' => $request->assigned_to,
            'type' => 'ticket_assigned',
            'title' => 'New Ticket Assigned',
            'message' => "You have been assigned ticket #{$ticket->id}: {$ticket->title}",
            'is_read' => false,
        ]);

        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket assigned successfully.');
    }

    public function unassign(Ticket $ticket)
    {
        $ticket->update([
            'assigned_to' => null,
            'status' => 'open'
        ]);

        return redirect()->route('admin.tickets.index')
                        ->with('success', 'Ticket unassigned successfully.');
    }

    public function assignForm($id)
    {
        $ticket = Ticket::findOrFail($id);
        $supports = User::where('role', 'support')->get();
        return view('admin.assign', compact('ticket', 'supports'));
    }
}
