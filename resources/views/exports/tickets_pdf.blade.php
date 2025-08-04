<!DOCTYPE html>
<html>
<head>
    <title>Tickets Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; }
    </style>
</head>
<body>
    <h3>Tickets Report ({{ now()->format('Y-m-d') }})</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Title</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $index => $ticket)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ ucfirst($ticket->status) }}</td>
                <td>{{ ucfirst($ticket->priority) }}</td>
                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
