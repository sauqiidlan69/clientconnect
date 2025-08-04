@extends('layouts.support')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">Rejected Tickets</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Ticket ID</th>
                    <th>Customer</th>
                    <th>Reason</th>
                    <th>Rejected By</th>
                    <th>Rejected At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rejectedTickets as $ticket)
                <tr>
                    <td>#{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->rejection_reason ?? 'N/A' }}</td>
                    <td>{{ $ticket->rejected_by->name ?? 'System' }}</td>
                    <td>{{ $ticket->updated_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
