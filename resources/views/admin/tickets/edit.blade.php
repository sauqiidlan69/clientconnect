@extends('layouts.admin')

@section('title', 'Edit Ticket')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Ticket #{{ $ticket->id }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-outline-primary">
                <i class="bi bi-eye me-2"></i>View Details
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

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Ticket Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer_id" class="form-label">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
                                    <option value="">Select Customer</option>
                                    @foreach(App\Models\Customer::all() as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id', $ticket->customer_id) == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="assigned_to" class="form-label">Assigned To</label>
                                <select name="assigned_to" id="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror">
                                    <option value="">Unassigned</option>
                                    @foreach(App\Models\User::where('role', 'support')->get() as $support)
                                        <option value="{{ $support->id }}" {{ old('assigned_to', $ticket->assigned_to) == $support->id ? 'selected' : '' }}>
                                            {{ $support->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $ticket->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="5" 
                                      class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                    <option value="on_hold" {{ old('status', $ticket->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="priority" class="form-label">Priority</label>
                                <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                    <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ old('priority', $ticket->priority) == 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status_note" class="form-label">Status Note</label>
                            <textarea name="status_note" id="status_note" rows="3" 
                                      class="form-control @error('status_note') is-invalid @enderror" 
                                      placeholder="Add any status-related notes...">{{ old('status_note', $ticket->status_note) }}</textarea>
                            @error('status_note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($ticket->rejection_reason)
                            <div class="mb-3">
                                <label for="rejection_reason" class="form-label">Rejection Reason</label>
                                <textarea name="rejection_reason" id="rejection_reason" rows="3" 
                                          class="form-control @error('rejection_reason') is-invalid @enderror" 
                                          placeholder="Reason for rejection (if applicable)...">{{ old('rejection_reason', $ticket->rejection_reason) }}</textarea>
                                @error('rejection_reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Update Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Current Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Current Status:</strong>
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

                    <div class="mb-3">
                        <strong>Current Priority:</strong>
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

                    <div class="mb-3">
                        <strong>Currently Assigned To:</strong>
                        <p>
                            @if($ticket->assignedUser)
                                <span class="badge bg-success">{{ $ticket->assignedUser->name }}</span>
                            @else
                                <span class="badge bg-secondary">Unassigned</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>Created:</strong>
                        <p>{{ $ticket->created_at->format('M d, Y g:i A') }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Last Updated:</strong>
                        <p>{{ $ticket->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
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
</div>
@endsection
