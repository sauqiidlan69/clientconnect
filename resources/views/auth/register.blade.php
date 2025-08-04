@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <!--<img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3" style="width: 60px;">-->
            <h2 class="fw-bold">Create Your Account</h2>
            <p class="text-muted">Join us and start your journey!</p>
          </div>
          
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label fw-semibold">Name</label>
              <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Your full name">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Email address</label>
              <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fw-semibold">Password</label>
              <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Choose a strong password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
              <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required placeholder="Retype your password">
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">Register</button>
          </form>
          <div class="mt-4 text-center">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="fw-semibold text-blue">Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection