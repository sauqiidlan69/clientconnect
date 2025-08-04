@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Forgot Password</h2>
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>
        <button type="submit" class="btn btn-warning w-100">Send Password Reset Link</button>
      </form>
    </div>
  </div>
</div>
@endsection