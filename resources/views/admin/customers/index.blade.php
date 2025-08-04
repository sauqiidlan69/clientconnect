@extends('layouts.admin')

@section('title', 'Manage Customers')

@section('admin-content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-info"><i class="bi bi-person-badge me-2"></i>Manage Customers</h2>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-info btn-lg shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Add New Customer
        </a>
    </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

    <form method="GET" action="{{ route('admin.customers.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
            <button class="btn btn-outline-info" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
            @if(request('search'))
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i> Clear
                </a>
            @endif
        </div>
    </form> 

    @if(request('search'))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span><i class="bi bi-search me-2"></i>Search results for: <strong>"{{ request('search') }}"</strong></span>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-x me-1"></i>Clear Search
            </a>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 fw-semibold text-muted">Name</th>
                                        <th class="px-4 py-3 border-0 fw-semibold text-muted">Email</th>
                                        <th class="px-4 py-3 border-0 fw-semibold text-muted">Created At</th>
                                        <th class="px-4 py-3 border-0 fw-semibold text-muted text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customers as $customer)
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person-circle text-info fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $customer->name }}</div>
                                                        <small class="text-muted">Customer</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">{{ $customer->email }}</td>
                                            <td class="px-4 py-3">{{ $customer->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-outline-warning btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                                    <p class="fs-5">No customers found</p>
                                                    <a href="{{ route('admin.customers.create') }}" class="btn btn-info">
                                                        <i class="bi bi-plus-circle me-2"></i>Add First Customer
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @if($customers->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
@endsection
