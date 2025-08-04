@extends('layouts.admin')

@section('title', 'Ticket Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ticket #{{ $ticket->id }} Details</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit Ticket
            </a>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Tickets
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ticket Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Title:</strong>
                            <p>{{ $ticket->title }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Customer:</strong>
                            <p>{{ $ticket->customer->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <p>
                                <span class="badge bg-{{ 
                                    $ticket->status === 'open' ? 'primary' : 
                                    ($ticket->status === 'in_progress' ? 'warning' : 
                                    ($ticket->status === 'closed' ? 'success' : 'secondary')) 
                                }}">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Priority:</strong>
                            <p>
                                <span class="badge bg-{{ 
                                    $ticket->priority === 'critical' ? 'danger' : 
                                    ($ticket->priority === 'high' ? 'warning' : 
                                    ($ticket->priority === 'medium' ? 'info' : 'secondary')) 
                                }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Assigned To:</strong>
                            <p>
                                @if($ticket->assignedUser)
                                    <span class="badge bg-success">{{ $ticket->assignedUser->name }}</span>
                                @else
                                    <span class="badge bg-secondary">Unassigned</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Created:</strong>
                            <p>{{ $ticket->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Description:</strong>
                        <div class="border rounded p-3 bg-light">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    @if($ticket->rejection_reason)
                        <div class="mb-3">
                            <strong>Rejection Reason:</strong>
                            <div class="border rounded p-3 bg-danger-subtle text-danger">
                                {{ $ticket->rejection_reason }}
                            </div>
                        </div>
                    @endif

                    @if($ticket->status_note)
                        <div class="mb-3">
                            <strong>Status Note:</strong>
                            <div class="border rounded p-3 bg-info-subtle">
                                {{ $ticket->status_note }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    @if(!$ticket->assigned_to)
                        <button type="button" class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#assignModal">
                            <i class="bi bi-person-plus me-2"></i>Assign to Support
                        </button>
                    @else
                        <form method="POST" action="{{ route('admin.tickets.unassign', $ticket) }}" class="mb-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-secondary w-100" onclick="return confirm('Unassign this ticket?')">
                                <i class="bi bi-person-dash me-2"></i>Unassign Ticket
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-warning w-100 mb-2">
                        <i class="bi bi-pencil me-2"></i>Edit Ticket
                    </a>

                    <form method="POST" action="{{ route('admin.tickets.destroy', $ticket) }}" class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Delete this ticket? This action cannot be undone.')">
                            <i class="bi bi-trash me-2"></i>Delete Ticket
                        </button>
                    </form>
                </div>
            </div>

            @if($ticket->customer)
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $ticket->customer->name }}</p>
                        <p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
                        @if($ticket->customer->phone)
                            <p><strong>Phone:</strong> {{ $ticket->customer->phone }}</p>
                        @endif
                        @if($ticket->customer->address)
                            <p><strong>Address:</strong> {{ $ticket->customer->address }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Assignment Modal -->
    @if(!$ticket->assigned_to)
        <div class="modal fade" id="assignModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.tickets.assign', $ticket) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h5 class="modal-title">Assign Ticket #{{ $ticket->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="assigned_to" class="form-label">Assign to Support User</label>
                                <select name="assigned_to" id="assigned_to" class="form-select" required>
                                    <option value="">Select Support User</option>
                                    @foreach(App\Models\User::where('role', 'support')->get() as $support)
                                        <option value="{{ $support->id }}">{{ $support->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Assign Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
