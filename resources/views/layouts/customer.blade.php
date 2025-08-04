@extends('layouts.base')

@section('title', 'Customer Portal')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-light vh-100">
            <!-- Customer Navigation -->
            <nav class="nav flex-column pt-3">
                <a class="nav-link" href="{{ route('customer.dashboard.index') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('customer.tickets.index') }}">My Tickets</a>
                <a class="nav-link" href="{{ route('customer.tickets.create') }}">Create Ticket</a>
                <a class="nav-link" href="{{ route('customer.profile.show') }}">Profile</a>
            </nav>
        </div>
        <div class="col-md-10">
            <main class="py-4">
                @include('components.alerts')
                @yield('content')
            </main>
        </div>
    </div>
</div>
@endsection