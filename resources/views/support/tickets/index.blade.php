@extends('layouts.support')

@section('title', 'My Assigned Tickets')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-ticket-perforated me-2"></i>My Assigned Tickets</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('support.tickets.assigned') }}" class="btn btn-outline-primary">
                <i class="bi bi-list-check me-2"></i>Assigned
            </a>
            <a href="{{ route('support.tickets.history') }}" class="btn btn-outline-secondary">
                <i class="bi bi-clock-history me-2"></i>History
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            @if($tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted">Ticket</th>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted">Customer</th>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted">Priority</th>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted">Status</th>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted">Created</th>
                                <th class="px-4 py-3 border-0 fw-semibold text-muted text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold">{{ $ticket->title }}</div>
                                            <small class="text-muted">ID: #{{ $ticket->id }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <span>{{ $ticket->customer->name ?? 'Unknown Customer' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($ticket->priority ?? 'low') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : ($ticket->status === 'assigned' || $ticket->status === 'accepted' ? 'info' : ($ticket->status === 'resolved' ? 'success' : 'danger')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold">{{ $ticket->created_at->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $ticket->created_at->diffForHumans() }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('support.tickets.show', $ticket) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            @if($ticket->status === 'assigned')
                                                <form action="{{ route('support.tickets.accept', $ticket) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                                        <i class="bi bi-check-circle"></i> Accept
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                        <p class="fs-5">No tickets assigned to you</p>
                        <p class="text-muted">Assigned tickets will appear here when an admin assigns them to you.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($tickets->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
