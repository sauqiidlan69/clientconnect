<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // Get or create customer record for the authenticated user
        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '', // Default empty, can be updated later
                'id_number' => '', // Default empty, can be updated later
                'address' => '', // Default empty, can be updated later
            ]
        );

        // Get tickets for this customer
        $tickets = Ticket::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'in:low,medium,high',
        ]);

        // Get or create customer record for the authenticated user
        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '', // Default empty, can be updated later
                'id_number' => '', // Default empty, can be updated later
                'address' => '', // Default empty, can be updated later
            ]
        );

        Ticket::create([
            'customer_id' => $customer->id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority ?? 'low',
            'status' => 'open', // Default status
        ]);

        return redirect()->route('customer.tickets.index')->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        // Ensure the ticket belongs to the authenticated customer
        $customer = Customer::where('user_id', Auth::id())->first();
        
        if (!$customer || $ticket->customer_id !== $customer->id) {
            abort(403, 'Unauthorized access to this ticket.');
        }
        
        return view('tickets.show', compact('ticket'));
    }

}
