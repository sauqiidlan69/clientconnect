@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <h2 class="fw-bold">Support Login</h2>
            <p class="text-muted">Access your support dashboard</p>
          </div>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control form-control-lg" id="email" name="email" required autofocus placeholder="Enter your Email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="Enter your password">
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="{{ route('password.request') }}" class="text-decoration-none small">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection