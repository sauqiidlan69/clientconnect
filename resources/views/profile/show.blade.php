@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            
                        </div>
                        <div>
                            <h2 class="mb-1 fw-bold text-primary">{{ Auth::user()->name }}</h2>
                            <span class="badge bg-gradient-primary text-uppercase px-3 py-2">{{ ucfirst(Auth::user()->role) }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <p class="mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i> <strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p class="mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i> <strong>Phone:</strong> {{ $customer->phone ?: 'Not provided' }}</p>
                        <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> <strong>Address:</strong> {{ $customer->address ?: 'Not provided' }}</p>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('profile.password') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 shadow-sm">
                            <i class="bi bi-key-fill me-2"></i>Reset Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
