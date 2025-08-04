@extends('layouts.admin')

@section('title', 'All Tickets')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-ticket-perforated me-2 text-primary"></i>Ticket Management
            </h1>
            <p class="text-muted mb-0">Manage and track all support tickets</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Create New Ticket
            </a>
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-funnel me-2"></i>Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?status=open">Open Tickets</a></li>
                <li><a class="dropdown-item" href="?status=in_progress">In Progress</a></li>
                <li><a class="dropdown-item" href="?status=closed">Closed Tickets</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('admin.tickets.index') }}">All Tickets</a></li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="mb-0 fw-semibold">All Tickets ({{ $tickets instanceof \Illuminate\Pagination\LengthAwarePaginator ? $tickets->total() : count($tickets) }})</h6>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0 bg-light" placeholder="Search tickets..." id="ticketSearch">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($tickets && count($tickets) > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold">ID</th>
                                <th class="border-0 fw-semibold">Customer</th>
                                <th class="border-0 fw-semibold">Title</th>
                                <th class="border-0 fw-semibold">Status</th>
                                <th class="border-0 fw-semibold">Priority</th>
                                <th class="border-0 fw-semibold">Assigned To</th>
                                <th class="border-0 fw-semibold">Updated</th>
                                <th class="border-0 fw-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="ticket-row" style="cursor: pointer;" onclick="window.location='{{ route('admin.tickets.show', $ticket) }}'">
                                    <td class="align-middle">
                                        <span class="badge bg-light text-dark fw-normal">#{{ $ticket->id }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <i class="bi bi-person text-white small"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $ticket->customer->name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ $ticket->customer->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="fw-semibold text-truncate" style="max-width: 200px;" title="{{ $ticket->title }}">
                                            {{ Str::limit($ticket->title, 40) }}
                                        </div>
                                        <small class="text-muted">{{ Str::limit($ticket->description, 60) }}</small>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ 
                                            $ticket->status === 'open' ? 'primary' : 
                                            ($ticket->status === 'in_progress' ? 'warning' : 
                                            ($ticket->status === 'closed' ? 'success' : 'secondary')) 
                                        }} px-3 py-2">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ 
                                            $ticket->priority === 'critical' ? 'danger' : 
                                            ($ticket->priority === 'high' ? 'warning' : 
                                            ($ticket->priority === 'medium' ? 'info' : 'secondary')) 
                                        }} px-3 py-2">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        @if($ticket->assignedUser)
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-success rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <i class="bi bi-person-check text-white small"></i>
                                                </div>
                                                <span class="fw-semibold">{{ $ticket->assignedUser->name }}</span>
                                            </div>
                                        @else
                                            <span class="badge bg-light text-muted">Unassigned</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-muted small">{{ $ticket->updated_at->diffForHumans() }}</div>
                                        <div class="text-muted small">{{ $ticket->updated_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group" onclick="event.stopPropagation();">
                                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-warning" title="Edit Ticket">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if(!$ticket->assigned_to)
                                                <button type="button" class="btn btn-sm btn-outline-success" title="Assign Ticket" data-bs-toggle="modal" data-bs-target="#assignModal{{ $ticket->id }}">
                                                    <i class="bi bi-person-plus"></i>
                                                </button>
                                            @else
                                                <form method="POST" action="{{ route('admin.tickets.unassign', $ticket) }}" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Unassign Ticket" onclick="return confirm('Unassign this ticket?')">
                                                        <i class="bi bi-person-dash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.tickets.destroy', $ticket) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Ticket" onclick="return confirm('Delete this ticket? This action cannot be undone.')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Assignment Modal for each ticket -->
                                @if(!$ticket->assigned_to)
                                    <div class="modal fade" id="assignModal{{ $ticket->id }}" tabindex="-1">
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
                                                            <label for="assigned_to{{ $ticket->id }}" class="form-label">Assign to Support User</label>
                                                            <select name="assigned_to" id="assigned_to{{ $ticket->id }}" class="form-select" required>
                                                                <option value="">Select Support User</option>
                                                                @foreach(App\Models\User::where('role', 'support')->get() as $support)
                                                                    <option value="{{ $support->id }}">{{ $support->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="alert alert-info">
                                                            <small><i class="bi bi-info-circle me-1"></i>The support user will receive a notification about this assignment.</small>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(method_exists($tickets, 'links'))
                    <div class="card-footer bg-white">
                        {{ $tickets->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-ticket-perforated text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted">No tickets found</h5>
                    <p class="text-muted">Create your first support ticket to get started.</p>
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create New Ticket
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 12px;
}

.ticket-row:hover {
    background-color: rgba(0, 123, 255, 0.05) !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.card {
    border-radius: 12px;
}

.table th {
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-group .btn {
    margin: 0 1px;
}

.badge {
    font-weight: 500;
    font-size: 0.75rem;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('ticketSearch');
    const tableRows = document.querySelectorAll('.ticket-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
