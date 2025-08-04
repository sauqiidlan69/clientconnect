@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Ticket</h2>
    @include('components.alert')

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('tickets.partials.form', ['ticket' => $ticket])
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
