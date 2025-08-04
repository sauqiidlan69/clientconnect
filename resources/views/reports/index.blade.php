@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Generate Reports</h2>

    <form method="GET" action="{{ route('reports.generate') }}" class="card p-4 shadow-sm">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="from" class="form-label">From Date</label>
                <input type="date" name="from" id="from" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="to" class="form-label">To Date</label>
                <input type="date" name="to" id="to" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="type" class="form-label">Report Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="tickets">Tickets</option>
                    <option value="customers">Customers</option>
                    <option value="interactions">Interactions</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" name="format" value="pdf" class="btn btn-danger">Download PDF</button>
            <button type="submit" name="format" value="csv" class="btn btn-primary">Download CSV</button>
        </div>
    </form>
</div>
@endsection
