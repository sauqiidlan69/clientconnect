@extends('layouts.support')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Assigned Tickets</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ticket ID</th>
                    <th>Customer</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>#{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td><span class="badge bg-warning">{{ $ticket->status }}</span></td>
                    <td>{{ ucfirst($ticket->priority) }}</td>
                    <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('support.tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
