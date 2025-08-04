<div class="mb-4">
    <label for="title" class="form-label fw-bold text-primary">Title</label>
    <input type="text" name="title" id="title" class="form-control rounded-pill shadow-sm @error('title') is-invalid @enderror" required value="{{ old('title', $ticket->title ?? '') }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label fw-bold text-primary">Description</label>
    <textarea name="description" id="description" class="form-control rounded-4 shadow-sm @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $ticket->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@unless(auth()->user()->isCustomer())
<div class="mb-4">
    <label for="priority" class="form-label fw-bold text-primary">Priority</label>
    <select name="priority" id="priority" class="form-select rounded-pill shadow-sm @error('priority') is-invalid @enderror">
        @foreach (['low', 'medium', 'high'] as $priority)
            <option value="{{ $priority }}" {{ old('priority', $ticket->priority ?? 'low') == $priority ? 'selected' : '' }}>
                {{ ucfirst($priority) }}
            </option>
        @endforeach
    </select>
    @error('priority')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@endunless
