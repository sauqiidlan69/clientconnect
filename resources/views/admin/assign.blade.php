@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Assign Tickets to Support Staff</h2>

    <form method="POST" action="{{ route('admin.tickets.assign') }}">
        @csrf

        <div class="mb-3">
            <label for="ticket_id" class="form-label">Select Ticket</label>
            <select class="form-select" name="ticket_id" required>
                <option value="">-- Choose Ticket --</option>
                @foreach ($unassignedTickets as $ticket)
                    <option value="{{ $ticket->id }}">#{{ $ticket->id }} - {{ $ticket->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="support_id" class="form-label">Assign To</label>
            <select class="form-select" name="support_id" required>
                <option value="">-- Choose Support Staff --</option>
                @foreach ($supportUsers as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Ticket</button>
    </form>
</div>
@endsection
