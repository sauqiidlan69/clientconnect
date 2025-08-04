@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0">
        <div class="card-body p-5">
          <h2 class="mb-4 text-center text-primary">Customer Login</h2>
          
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" id="password" name="password" required>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection