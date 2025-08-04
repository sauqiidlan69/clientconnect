@extends('layouts.guest')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="alert alert-info text-center">
        <h4 class="alert-heading">Verify Your Email Address</h4>
        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, click the button below to request another.</p>
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="btn btn-primary">Resend Verification Email</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection