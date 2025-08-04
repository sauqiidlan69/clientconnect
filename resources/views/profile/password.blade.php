@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4 fw-bold text-primary">
                        <i class="bi bi-key-fill me-2"></i>Reset Password
                    </h2>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-lock me-2"></i>Current Password
                            </label>
                            <input type="password" name="current_password" class="form-control form-control-lg rounded-pill" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-2"></i>New Password
                            </label>
                            <input type="password" name="new_password" class="form-control form-control-lg rounded-pill" required>
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-check-circle me-2"></i>Confirm New Password
                            </label>
                            <input type="password" name="new_password_confirmation" class="form-control form-control-lg rounded-pill" required>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 flex-grow-1">
                                <i class="bi bi-check-circle me-2"></i>Update Password
                            </button>
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
