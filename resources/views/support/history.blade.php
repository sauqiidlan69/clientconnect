@extends('layouts.support')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Ticket History</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Ticket ID</th>
                    <th>Customer</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Closed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $ticket)
                <tr>
                    <td>#{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td><span class="badge bg-secondary">{{ $ticket->status }}</span></td>
                    <td>{{ $ticket->closed_at ? $ticket->closed_at->format('Y-m-d') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
