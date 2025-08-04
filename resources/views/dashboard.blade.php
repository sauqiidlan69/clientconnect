@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Welcome, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</h2>

    <div class="row mt-4">
        @if(Auth::user()->isAdmin())
            @include('dashboard.admin.index')
        @elseif(Auth::user()->isSupport())
            @include('dashboard.support.index')
        @else
            @include('dashboard.customer.index')
        @endif
    </div>
</div>
@endsection
