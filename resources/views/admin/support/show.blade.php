@extends('layouts.admin')

@section('title', 'Support Staff Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-white sidebar py-4 rounded-end-4 shadow-lg border-end">
            <div class="position-sticky">
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door me-2 fs-5"></i> <span>Dashboard</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.support.*') ? 'active fw-bold text-success bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.support.index') }}">
                    <i class="bi bi-headset me-2 fs-5"></i> <span>Manage All Support</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.customers.*') ? 'active fw-bold text-info bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.customers.index') }}">
                    <i class="bi bi-person-badge me-2 fs-5"></i> <span>Manage All Customer</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.tickets.*') ? 'active fw-bold text-warning bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.tickets.index') }}">
                    <i class="bi bi-ticket-detailed me-2 fs-5"></i> <span>Manage All Ticket</span>
                </a>
                </li>
            </ul>
            </div>
        </nav>
        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto px-4">
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-success"><i class="bi bi-person-circle me-2"></i>Support Staff Details</h2>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.support.edit', $support) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.support.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Support List
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-person-circle text-success fs-2"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">{{ $support->name }}</h4>
                                        <p class="text-muted mb-0">Support Staff</p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-muted">Email Address</label>
                                        <p class="fs-5">{{ $support->email }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-muted">Role</label>
                                        <p class="fs-5">
                                            <span class="badge bg-success fs-6">{{ ucfirst($support->role) }}</span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-muted">Joined Date</label>
                                        <p class="fs-5">{{ $support->created_at->format('F j, Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-muted">Last Updated</label>
                                        <p class="fs-5">{{ $support->updated_at->format('F j, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <h6 class="fw-semibold text-muted">Quick Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.support.edit', $support) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil me-2"></i>Edit Details
                                        </a>
                                        <form action="{{ route('admin.support.destroy', $support) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete this support staff?')">
                                                <i class="bi bi-trash me-2"></i>Delete Account
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
