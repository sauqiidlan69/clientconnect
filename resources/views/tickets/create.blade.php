@extends('layouts.customer')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Create New Ticket</h2>
    @include('components.alerts')

    <form action="{{ route('customer.tickets.store') }}" method="POST">
        @csrf
        @include('tickets.partials.customer-form', ['ticket' => null])
        <button type="submit" class="btn btn-success mt-3">Submit Ticket</button>
    </form>
</div>
@endsection
