@extends('layouts.customer')

@section('content')
<div class="container mt-4">
    <h2>Ticket Details</h2>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $ticket->title }}</h5>
            <p><strong>Description:</strong> {{ $ticket->description }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $ticket->status === 'open' ? 'primary' : ($ticket->status === 'closed' ? 'success' : 'warning') }}">
                    {{ ucfirst($ticket->status ?? 'open') }}
                </span>
            </p>
            <p><strong>Priority:</strong> 
                <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($ticket->priority ?? 'low') }}
                </span>
            </p>
            <p><strong>Assigned To:</strong> {{ $ticket->assignedUser->name ?? 'Unassigned' }}</p>
            <p><strong>Created At:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
    <a href="{{ route('customer.tickets.index') }}" class="btn btn-secondary mt-3">Back to My Tickets</a>
</div>
@endsection
