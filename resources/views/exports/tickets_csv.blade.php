<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Title</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->customer->name }}</td>
            <td>{{ $ticket->title }}</td>
            <td>{{ ucfirst($ticket->status) }}</td>
            <td>{{ ucfirst($ticket->priority) }}</td>
            <td>{{ $ticket->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
