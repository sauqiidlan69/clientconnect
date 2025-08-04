<div class="mb-3">
    <label for="customer_id" class="form-label">Customer</label>
    <select name="customer_id" id="customer_id" class="form-select" required>
        @foreach ($customers as $customer)
            <option value="{{ $customer->id }}" {{ isset($ticket) && $ticket->customer_id == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $ticket->title ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $ticket->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="priority" class="form-label">Priority</label>
    <select name="priority" id="priority" class="form-select">
        @foreach (['low', 'medium', 'high'] as $priority)
            <option value="{{ $priority }}" {{ old('priority', $ticket->priority ?? '') == $priority ? 'selected' : '' }}>
                {{ ucfirst($priority) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
        @foreach (['open', 'in_progress', 'closed', 'rejected'] as $status)
            <option value="{{ $status }}" {{ old('status', $ticket->status ?? '') == $status ? 'selected' : '' }}>
                {{ ucfirst(str_replace('_', ' ', $status)) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="assigned_to" class="form-label">Assign To</label>
    <select name="assigned_to" id="assigned_to" class="form-select">
        <option value="">-- Select Support User --</option>
        @foreach ($supportUsers as $user)
            <option value="{{ $user->id }}" {{ old('assigned_to', $ticket->assigned_to ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>
