@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-bell me-2"></i>Notifications
        </h2>
        <span class="badge bg-primary fs-6">{{ $notifications->count() }} Total</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($notifications->isEmpty())
        <div class="alert alert-info border-0 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-2 fs-4"></i>
                <div>
                    <h6 class="mb-0">No notifications available</h6>
                    <small class="text-muted">You're all caught up! New notifications will appear here.</small>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($notifications as $notification)
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm {{ $notification->is_read ? 'bg-light' : 'bg-white' }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-{{ 
                                            $notification->type === 'ticket_assigned' ? 'success' : 
                                            ($notification->type === 'ticket_updated' ? 'warning' : 'info') 
                                        }} me-2">
                                            {{ ucfirst(str_replace('_', ' ', $notification->type)) }}
                                        </span>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-danger">New</span>
                                        @endif
                                    </div>
                                    <h6 class="card-title mb-2">{{ $notification->title }}</h6>
                                    <p class="card-text text-muted mb-2">{{ $notification->message }}</p>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                @if(!$notification->is_read)
                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ms-3">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Mark as read">
                                            <i class="bi bi-check2"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success ms-3" title="Already read">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .card {
        transition: transform 0.2s ease-in-out;
        border-radius: 1rem;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .badge {
        font-size: 0.75em;
    }
</style>
@endsection
