<form action="{{ route('support.interactions.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf
    <div class="mb-3">
        <label for="customer_id" class="form-label">Select Customer</label>
        <select name="customer_id" id="customer_id" class="form-select" required>
            <option value="" disabled selected>-- Choose Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Please select a customer.</div>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Interaction Type</label>
        <select name="type" id="type" class="form-select" required>
            <option value="" disabled selected>-- Choose Type --</option>
            <option value="call">Call</option>
            <option value="email">Email</option>
            <option value="meeting">Meeting</option>
            <option value="support_chat">Support Chat</option>
        </select>
        <div class="invalid-feedback">Please select the interaction type.</div>
    </div>

    <div class="mb-3">
        <label for="interaction_date" class="form-label">Date & Time</label>
        <input type="datetime-local" name="interaction_date" id="interaction_date" class="form-control" required>
        <div class="invalid-feedback">Please select the date and time.</div>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Interaction Notes</label>
        <textarea name="notes" id="notes" rows="4" class="form-control" required></textarea>
        <div class="invalid-feedback">Please add some notes.</div>
    </div>

    <button type="submit" class="btn btn-primary">Log Interaction</button>
</form>

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
