@extends('layouts.support')

@section('title', 'Support Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">Support Dashboard</h2>
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body text-center">
                    <i class="bi bi-ticket-perforated display-4 mb-2"></i>
                    <h5 class="card-title">Total Assigned</h5>
                    <p class="card-text display-6 fw-bold">{{ $assignedTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-warning text-white">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-circle display-4 mb-2"></i>
                    <h5 class="card-title">Open Tickets</h5>
                    <p class="card-text display-6 fw-bold">{{ $openTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-clockwise display-4 mb-2"></i>
                    <h5 class="card-title">In Progress</h5>
                    <p class="card-text display-6 fw-bold">{{ $inProgressTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle display-4 mb-2"></i>
                    <h5 class="card-title">Closed</h5>
                    <p class="card-text display-6 fw-bold">{{ $closedTickets }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets and Notifications -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Assigned Tickets</h5>
                </div>
                <div class="card-body">
                    @if($recentTickets->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentTickets as $ticket)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $ticket->title }}</h6>
                                        <small class="text-muted">{{ $ticket->customer->name ?? 'Unknown Customer' }}</small>
                                    </div>
                                    <div>
                                        <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : ($ticket->status === 'in_progress' ? 'info' : 'success') }}">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                        <small class="text-muted d-block">{{ $ticket->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-3">No recent tickets assigned</p>
                    @endif
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('support.tickets.index') }}" class="btn btn-outline-primary btn-sm">View All Tickets</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-bell me-2"></i>Recent Notifications</h5>
                </div>
                <div class="card-body">
                    @if($unreadNotifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($unreadNotifications as $notification)
                                <div class="list-group-item">
                                    <p class="mb-1">{{ $notification->message }}</p>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-3">No new notifications</p>
                    @endif
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('notifications.index') }}" class="btn btn-outline-primary btn-sm">View All Notifications</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
