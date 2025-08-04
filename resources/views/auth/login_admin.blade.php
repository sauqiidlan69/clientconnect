@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient-primary text-center rounded-top-4 text-black">
          <h3 class="mb-0"><i class="bi bi-shield-lock"></i> Admin Login</h3>
        </div>
        <div class="card-body p-4">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
              <label for="email" class="form-label fw-bold">Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required autofocus>
              </div>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label fw-bold">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection