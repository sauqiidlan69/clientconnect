@extends('layouts.support')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Ticket #{{ $ticket->id }} Details</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $ticket->title }}</h5>
            <p class="card-text">{{ $ticket->description }}</p>
            <hr>
            <p><strong>Customer:</strong> {{ $ticket->customer->name }}</p>
            <p><strong>Status:</strong> <span class="badge bg-info">{{ $ticket->status }}</span></p>
            <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
        </div>
    </div>

    @include('dashboard.support.partials.interaction_form', ['ticket' => $ticket])
</div>
@endsection
