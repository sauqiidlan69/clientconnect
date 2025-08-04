@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">My Tickets</h2>
        <a href="{{ route('customer.tickets.create') }}" class="btn btn-gradient-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Create New Ticket
        </a>
    </div>

    @include('components.alerts')

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Assigned To</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td class="fw-semibold">{{ $ticket->id }}</td>
                                <td>{{ $ticket->customer->name ?? 'N/A' }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>
                                    <span class="badge 
                                        @if($ticket->status === 'open') bg-primary
                                        @elseif($ticket->status === 'closed') bg-success
                                        @else bg-warning text-dark
                                        @endif
                                    ">
                                        {{ ucfirst($ticket->status ?? 'open') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $ticket->assignedUser->name ?? 'Unassigned' }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary">{{ $ticket->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-ticket-perforated fs-3"></i>
                                    <div>No tickets found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
        color: #fff;
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(90deg, #8f94fb 0%, #4e54c8 100%);
        color: #fff;
    }
</style>
@endsection
