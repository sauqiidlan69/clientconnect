@extends('layouts.customer')

@section('title', 'Customer Dashboard')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold display-5 text-gradient-primary">Welcome, {{ auth()->user()->name }}</h2>
        <p class="text-muted fs-5">Your personal support dashboard</p>
    </div>
    <div class="row justify-content-center g-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg h-100 bg-light position-relative overflow-hidden">
                <div class="card-body text-center">
                   
                    <h5 class="card-title fw-semibold fs-4">My Tickets</h5>
                    <p class="card-text fs-1 fw-bold text-primary mb-1">{{ $ticketCount }}</p>
                    <a href="{{ route('customer.tickets.index') }}" class="btn btn-primary btn-lg mt-3 px-4 rounded-pill shadow-sm">
                        <i class="bi bi-eye"></i> View My Tickets
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow-lg h-100 bg-light position-relative overflow-hidden">
                <div class="card-body text-center">
                    
                    <h5 class="card-title fw-semibold fs-4">Create New Ticket</h5>
                    <p class="card-text text-muted fs-6">Submit a new support ticket for quick assistance</p>
                    <a href="{{ route('customer.tickets.create') }}" class="btn btn-success btn-lg mt-3 px-4 rounded-pill shadow-sm">
                        <i class="bi bi-pencil-square"></i> Create Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.text-gradient-primary {
    background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
@endsection
