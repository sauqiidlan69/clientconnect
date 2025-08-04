@extends('layouts.support')

@section('title', 'Ticket Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-ticket-detailed me-2"></i>Ticket #{{ $ticket->id }}
        </h2>
        <a href="{{ route('support.tickets.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Tickets
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <!-- Ticket Details Card -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $ticket->title }}</h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'secondary') }} fs-6">
                            {{ ucfirst($ticket->priority ?? 'low') }} Priority
                        </span>
                        <span class="badge bg-{{ 
                            $ticket->status === 'open' ? 'warning' : 
                            ($ticket->status === 'assigned' || $ticket->status === 'accepted' ? 'info' : 
                            ($ticket->status === 'in_progress' ? 'primary' : 
                            ($ticket->status === 'closed' ? 'success' : 
                            ($ticket->status === 'on_hold' ? 'secondary' : 'danger')))) 
                        }} fs-6">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="text-muted mb-2">Description:</h6>
                    <p class="mb-3">{{ $ticket->description }}</p>
                    
                    @if($ticket->due_date)
                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Due Date:</h6>
                            <span class="badge bg-{{ $ticket->due_date->isPast() ? 'danger' : 'info' }} fs-6">
                                {{ $ticket->due_date->format('F j, Y') }}
                                @if($ticket->due_date->isPast())
                                    (Overdue)
                                @endif
                            </span>
                        </div>
                    @endif

                    @if($ticket->rejection_reason)
                        <div class="alert alert-warning">
                            <strong>Rejection Reason:</strong> {{ $ticket->rejection_reason }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Update Card -->
            @if(in_array($ticket->status, ['assigned', 'accepted', 'in_progress', 'on_hold']))
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Update Status</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('support.tickets.status', $ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label fw-semibold">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                        <option value="on_hold" {{ $ticket->status === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="status_note" class="form-label fw-semibold">Status Note (Optional)</label>
                                <textarea name="status_note" id="status_note" class="form-control" rows="3" 
                                          placeholder="Add a note about this status change...">{{ $ticket->status_note }}</textarea>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Update Status
                                </button>
                                
                                @if($ticket->status === 'assigned')
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptModal">
                                        <i class="bi bi-check-circle me-2"></i>Accept Ticket
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                        <i class="bi bi-x-circle me-2"></i>Reject Ticket
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Customer Info Card -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-person me-2"></i>Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="bi bi-person-circle text-primary fs-4"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $ticket->customer->name ?? 'Unknown Customer' }}</div>
                            <small class="text-muted">{{ $ticket->customer->email ?? 'No email' }}</small><br>
                            <small class="text-muted">{{ $ticket->customer->phone ?? 'No phone' }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Info Card -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Ticket Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Created:</small>
                        <div class="fw-semibold">{{ $ticket->created_at->format('F j, Y g:i A') }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Last Updated:</small>
                        <div class="fw-semibold">{{ $ticket->updated_at->format('F j, Y g:i A') }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Time Elapsed:</small>
                        <div class="fw-semibold">{{ $ticket->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accept Modal -->
<div class="modal fade" id="acceptModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accept Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to accept this ticket? This will change the status to "In Progress".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('support.tickets.accept', $ticket) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Accept Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('support.tickets.reject', $ticket) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Reason for Rejection</label>
                        <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="3" 
                                  placeholder="Please explain why you're rejecting this ticket..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
