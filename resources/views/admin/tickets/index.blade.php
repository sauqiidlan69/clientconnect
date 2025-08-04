@extends('layouts.admin')

@section('title', 'Manage Tickets')

@section('page-title', 'Manage Tickets')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tickets</li>
@endsection

@section('page-actions')
    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-2"></i>
        <span class="d-none d-sm-inline">Create New Ticket</span>
        <span class="d-inline d-sm-none">New</span>
    </a>
@endsection

@section('admin-content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.tickets.index') }}" class="mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-8">
                        <label for="search" class="form-label fw-semibold">
                            <i class="bi bi-search me-1"></i>Search Tickets
                        </label>
                        </label>
                        <input type="text" name="search" id="search" class="form-control form-control-lg" 
                               placeholder="Search by ticket title..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4 mt-3 mt-md-0">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(request('search'))
        <div class="alert alert-info border-0 mb-4">
            <i class="bi bi-info-circle me-2"></i>
            Showing search results for: <strong>"{{ request('search') }}"</strong>
            <span class="badge bg-primary ms-2">{{ $tickets->total() }} found</span>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Assigned To</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td class="fw-bold text-primary">{{ $ticket->id }}</td>
                                <td>
                                    <span class="badge bg-light text-dark px-2 py-1">
                                        {{ $ticket->customer->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-decoration-none fw-semibold text-dark">
                                        {{ Str::limit($ticket->title, 50) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge px-3 py-2 bg-{{ 
                                        $ticket->status === 'open' ? 'primary' : 
                                        ($ticket->status === 'in_progress' ? 'warning' : 
                                        ($ticket->status === 'closed' ? 'success' : 'secondary')) 
                                    }}">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge px-3 py-2 bg-{{ 
                                        $ticket->priority === 'critical' ? 'danger' : 
                                        ($ticket->priority === 'high' ? 'warning' : 
                                        ($ticket->priority === 'medium' ? 'info' : 'secondary')) 
                                    }}">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td>
                                    @if($ticket->assignedUser)
                                        <span class="badge bg-success px-2 py-1">
                                            <i class="bi bi-person-check me-1"></i>{{ $ticket->assignedUser->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-2 py-1">
                                            <i class="bi bi-person-x me-1"></i>Unassigned
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $ticket->created_at->format('M d, Y') }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if(!$ticket->assigned_to)
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#assignModal{{ $ticket->id }}" title="Assign">
                                                <i class="bi bi-person-plus"></i>
                                            </button>
                                        @else
                                            <form method="POST" action="{{ route('admin.tickets.unassign', $ticket) }}" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Unassign this ticket?')" title="Unassign">
                                                    <i class="bi bi-person-dash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this ticket?')" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Assignment Modal -->
                            <div class="modal fade" id="assignModal{{ $ticket->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.tickets.assign', $ticket) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header bg-gradient">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-person-plus me-2"></i>Assign Ticket #{{ $ticket->id }}
                                                </h5>
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
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-ticket-detailed display-1 text-muted mb-3"></i>
                                        <h5 class="text-muted">
                                            @if(request('search'))
                                                No tickets found matching "{{ request('search') }}"
                                            @else
                                                No tickets found
                                            @endif
                                        </h5>
                                        <p class="text-muted mb-3">
                                            @if(request('search'))
                                                Try adjusting your search terms or clear the search to see all tickets.
                                            @else
                                                Get started by creating your first ticket.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-primary">
                                                <i class="bi bi-arrow-left me-2"></i>View All Tickets
                                            </a>
                                        @else
                                            <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-2"></i>Create New Ticket
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Custom Beautiful Pagination -->
            @if($tickets->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <div class="pagination-info">
                        <span class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing {{ $tickets->firstItem() ?? 0 }} to {{ $tickets->lastItem() ?? 0 }} 
                            of {{ $tickets->total() }} results
                        </span>
                    </div>
                    
                    <nav aria-label="Ticket pagination">
                        <ul class="pagination pagination-custom mb-0">
                            {{-- Previous Page Link --}}
                            @if($tickets->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="bi bi-chevron-left"></i>
                                        <span class="d-none d-sm-inline ms-1">Previous</span>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tickets->previousPageUrl() }}" rel="prev">
                                        <i class="bi bi-chevron-left"></i>
                                        <span class="d-none d-sm-inline ms-1">Previous</span>
                                    </a>
                                </li>
                            @endif

                            {{-- First Page --}}
                            @if($tickets->currentPage() > 3)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tickets->url(1) }}">1</a>
                                </li>
                                @if($tickets->currentPage() > 4)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif

                            {{-- Page Numbers --}}
                            @for($i = max(1, $tickets->currentPage() - 2); $i <= min($tickets->lastPage(), $tickets->currentPage() + 2); $i++)
                                @if($i == $tickets->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">
                                            {{ $i }}
                                            <span class="sr-only">(current)</span>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tickets->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            {{-- Last Page --}}
                            @if($tickets->currentPage() < $tickets->lastPage() - 2)
                                @if($tickets->currentPage() < $tickets->lastPage() - 3)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tickets->url($tickets->lastPage()) }}">{{ $tickets->lastPage() }}</a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if($tickets->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tickets->nextPageUrl() }}" rel="next">
                                        <span class="d-none d-sm-inline me-1">Next</span>
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <span class="d-none d-sm-inline me-1">Next</span>
                                        <i class="bi bi-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    
                    <!-- Page Jump -->
                    <div class="page-jump d-none d-md-block">
                        <form method="GET" action="{{ route('admin.tickets.index') }}" class="d-flex align-items-center">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <label class="text-muted me-2 small">Go to:</label>
                            <input type="number" name="page" min="1" max="{{ $tickets->lastPage() }}" 
                                   value="{{ $tickets->currentPage() }}" 
                                   class="form-control form-control-sm page-input" style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%);
        color: #fff;
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(90deg, #0056b3 0%, #0096c7 100%);
        color: #fff;
    }
    .table-gradient th {
        background: linear-gradient(90deg, #e3f2fd 0%, #f1f8e9 100%);
        color: #333;
        font-weight: 600;
    }
    .card {
        border-radius: 1rem;
    }
    .modal-header.bg-gradient {
        background: linear-gradient(90deg, #e3f2fd 0%, #f1f8e9 100%);
    }
    
    /* Custom Pagination Styles */
    .pagination-custom {
        --bs-pagination-padding-x: 0.75rem;
        --bs-pagination-padding-y: 0.5rem;
        --bs-pagination-font-size: 0.875rem;
        --bs-pagination-color: #6c757d;
        --bs-pagination-bg: #fff;
        --bs-pagination-border-width: 1px;
        --bs-pagination-border-color: #dee2e6;
        --bs-pagination-border-radius: 0.5rem;
        --bs-pagination-hover-color: #0056b3;
        --bs-pagination-hover-bg: #e9ecef;
        --bs-pagination-hover-border-color: #dee2e6;
        --bs-pagination-focus-color: #0056b3;
        --bs-pagination-focus-bg: #e9ecef;
        --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: #007bff;
        --bs-pagination-active-border-color: #007bff;
        --bs-pagination-disabled-color: #6c757d;
        --bs-pagination-disabled-bg: #fff;
        --bs-pagination-disabled-border-color: #dee2e6;
    }
    
    .pagination-custom .page-link {
        position: relative;
        display: block;
        padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
        font-size: var(--bs-pagination-font-size);
        color: var(--bs-pagination-color);
        text-decoration: none;
        background-color: var(--bs-pagination-bg);
        border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        border-radius: var(--bs-pagination-border-radius);
        margin: 0 2px;
        min-width: 40px;
        text-align: center;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .pagination-custom .page-link:hover {
        z-index: 2;
        color: var(--bs-pagination-hover-color);
        background-color: var(--bs-pagination-hover-bg);
        border-color: var(--bs-pagination-hover-border-color);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .pagination-custom .page-link:focus {
        z-index: 3;
        color: var(--bs-pagination-focus-color);
        background-color: var(--bs-pagination-focus-bg);
        outline: 0;
        box-shadow: var(--bs-pagination-focus-box-shadow);
    }
    
    .pagination-custom .page-item:not(:first-child) .page-link {
        margin-left: 0;
    }
    
    .pagination-custom .page-item.active .page-link {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border-color: var(--bs-pagination-active-border-color);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        transform: translateY(-1px);
    }
    
    .pagination-custom .page-item.disabled .page-link {
        color: var(--bs-pagination-disabled-color);
        pointer-events: none;
        background-color: var(--bs-pagination-disabled-bg);
        border-color: var(--bs-pagination-disabled-border-color);
        opacity: 0.6;
    }
    
    .pagination-info {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        font-weight: 500;
    }
    
    .page-jump {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }
    
    .page-input {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        text-align: center;
        font-weight: 500;
    }
    
    .page-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    @media (max-width: 576px) {
        .pagination-custom .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            min-width: 32px;
        }
        
        .pagination-info {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }
    }
    
    /* Empty State Styles */
    .empty-state {
        padding: 2rem 1rem;
    }
    
    .empty-state .display-1 {
        font-size: 4rem;
        opacity: 0.3;
    }
    
    /* Search Enhancement */
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    /* Card Hover Effects */
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
