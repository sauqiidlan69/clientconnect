@extends('layouts.admin')

@section('title', 'Reports')

@section('admin-content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">
            <i class="bi bi-graph-up me-2"></i>Reports & Analytics
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Customer Reports -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people me-2"></i>Customer Reports
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Generate comprehensive reports for customer data with filtering options.</p>
                    
                    <form action="{{ route('admin.reports.customers') }}" method="POST" id="customerReportForm">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer_date_from" class="form-label">From Date</label>
                                <input type="date" class="form-control" id="customer_date_from" name="date_from">
                            </div>
                            <div class="col-md-6">
                                <label for="customer_date_to" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="customer_date_to" name="date_to">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Report Format</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="format" id="customer_csv" value="csv" checked>
                                <label class="btn btn-outline-success" for="customer_csv">
                                    <i class="bi bi-file-earmark-spreadsheet me-1"></i>Excel/CSV
                                </label>
                                
                                <input type="radio" class="btn-check" name="format" id="customer_pdf" value="pdf">
                                <label class="btn btn-outline-danger" for="customer_pdf">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info w-100">
                            <i class="bi bi-download me-2"></i>Generate Customer Report
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ticket Reports -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-warning text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-ticket-detailed me-2"></i>Ticket Reports
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Generate detailed reports for tickets with advanced filtering capabilities.</p>
                    
                    <form action="{{ route('admin.reports.tickets') }}" method="POST" id="ticketReportForm">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ticket_date_from" class="form-label">From Date</label>
                                <input type="date" class="form-control" id="ticket_date_from" name="date_from">
                            </div>
                            <div class="col-md-6">
                                <label for="ticket_date_to" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="ticket_date_to" name="date_to">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status_filter" class="form-label">Status</label>
                                <select class="form-select" id="status_filter" name="status">
                                    <option value="">All Statuses</option>
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="closed">Closed</option>
                                    <option value="on_hold">On Hold</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="priority_filter" class="form-label">Priority</label>
                                <select class="form-select" id="priority_filter" name="priority">
                                    <option value="">All Priorities</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Report Format</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="format" id="ticket_csv" value="csv" checked>
                                <label class="btn btn-outline-success" for="ticket_csv">
                                    <i class="bi bi-file-earmark-spreadsheet me-1"></i>Excel/CSV
                                </label>
                                
                                <input type="radio" class="btn-check" name="format" id="ticket_pdf" value="pdf">
                                <label class="btn btn-outline-danger" for="ticket_pdf">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-download me-2"></i>Generate Ticket Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Statistics -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-bar-chart me-2"></i>Quick Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="stat-card p-3 bg-light rounded">
                                <i class="bi bi-people-fill text-info fs-1"></i>
                                <h3 class="mt-2 mb-0">{{ \App\Models\Customer::count() }}</h3>
                                <p class="text-muted mb-0">Total Customers</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card p-3 bg-light rounded">
                                <i class="bi bi-ticket-detailed-fill text-warning fs-1"></i>
                                <h3 class="mt-2 mb-0">{{ \App\Models\Ticket::count() }}</h3>
                                <p class="text-muted mb-0">Total Tickets</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card p-3 bg-light rounded">
                                <i class="bi bi-clock-history text-danger fs-1"></i>
                                <h3 class="mt-2 mb-0">{{ \App\Models\Ticket::where('status', 'open')->count() }}</h3>
                                <p class="text-muted mb-0">Open Tickets</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card p-3 bg-light rounded">
                                <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                <h3 class="mt-2 mb-0">{{ \App\Models\Ticket::where('status', 'closed')->count() }}</h3>
                                <p class="text-muted mb-0">Closed Tickets</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-info {
        background: linear-gradient(90deg, #17a2b8 0%, #20c997 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(90deg, #ffc107 0%, #fd7e14 100%);
    }
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff 0%, #6f42c1 100%);
    }
    .stat-card {
        transition: transform 0.2s ease-in-out;
    }
    .stat-card:hover {
        transform: translateY(-2px);
    }
    .card {
        border-radius: 1rem;
    }
    .btn-group .btn-check:checked + .btn {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set max date to today for all date inputs
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.max = today;
    });

    // Form validation
    document.getElementById('customerReportForm').addEventListener('submit', function(e) {
        const dateFrom = document.getElementById('customer_date_from').value;
        const dateTo = document.getElementById('customer_date_to').value;
        
        if (dateFrom && dateTo && dateFrom > dateTo) {
            e.preventDefault();
            alert('From date cannot be after To date');
        }
    });

    document.getElementById('ticketReportForm').addEventListener('submit', function(e) {
        const dateFrom = document.getElementById('ticket_date_from').value;
        const dateTo = document.getElementById('ticket_date_to').value;
        
        if (dateFrom && dateTo && dateFrom > dateTo) {
            e.preventDefault();
            alert('From date cannot be after To date');
        }
    });
});
</script>
@endsection
