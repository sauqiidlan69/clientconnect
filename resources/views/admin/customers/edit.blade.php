@extends('layouts.admin')

@section('title', 'Edit Customer')

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
                    <h2 class="fw-bold text-info"><i class="bi bi-pencil-square me-2"></i>Edit Customer</h2>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Customer List
                    </a>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-info px-4">
                                    <i class="bi bi-check-circle me-2"></i>Update Customer
                                </button>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary px-4">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
