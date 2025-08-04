@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">System Notifications</h2>

    <ul class="list-group">
        @forelse ($notifications as $notification)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">{{ $notification->title }}</div>
                {{ $notification->message }}
            </div>
            <span class="badge bg-info rounded-pill">{{ $notification->created_at->diffForHumans() }}</span>
        </li>
        @empty
        <li class="list-group-item">No notifications found.</li>
        @endforelse
    </ul>
</div>
@endsection
