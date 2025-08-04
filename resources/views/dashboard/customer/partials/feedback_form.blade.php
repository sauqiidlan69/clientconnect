<form action="{{ route('customer.feedback.store') }}" method="POST" class="needs-validation p-4 rounded shadow-sm bg-white" novalidate>
    @csrf

    <h4 class="mb-4 text-primary"><i class="bi bi-chat-dots"></i> Share Your Feedback</h4>

    <div class="mb-3">
        <label for="ticket_id" class="form-label fw-semibold">
            <i class="bi bi-ticket-detailed"></i> Related Ticket
        </label>
        <select name="ticket_id" id="ticket_id" class="form-select border-primary" required>
            <option value="" disabled selected>-- Select Ticket --</option>
            @foreach($tickets as $ticket)
                <option value="{{ $ticket->id }}">{{ $ticket->title }} (#{{ $ticket->id }})</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Please choose a ticket.</div>
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label fw-semibold">
            <i class="bi bi-star-fill text-warning"></i> Rating
        </label>
        <select name="rating" id="rating" class="form-select border-warning" required>
            <option value="" disabled selected>-- Rate Us --</option>
            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
            <option value="4">⭐⭐⭐⭐ - Good</option>
            <option value="3">⭐⭐⭐ - Average</option>
            <option value="2">⭐⭐ - Poor</option>
            <option value="1">⭐ - Terrible</option>
        </select>
        <div class="invalid-feedback">Please provide a rating.</div>
    </div>

    <div class="mb-3">
        <label for="comments" class="form-label fw-semibold">
            <i class="bi bi-pencil-square"></i> Your Feedback
        </label>
        <textarea name="comments" id="comments" rows="4" class="form-control border-info" placeholder="Write something helpful..." required></textarea>
        <div class="invalid-feedback">Please write your comments.</div>
    </div>

    <button type="submit" class="btn btn-success w-100 fw-bold">
        <i class="bi bi-send"></i> Submit Feedback
    </button>
</form>

<!-- Optionally include Bootstrap Icons if not already loaded -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script>
    // Bootstrap form validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form =>
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            })
        );
    })();
</script>
