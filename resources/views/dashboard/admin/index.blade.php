@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
<div class="container py-5">
    <h2 class="mb-5 fw-bold text-center text-primary display-5">Admin Dashboard</h2>
    <div class="row g-4 justify-content-center">
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-lg rounded-4 position-relative overflow-hidden" style="background: linear-gradient(120deg, #007bff 70%, #6fb1fc 100%);">
                            <span class="position-absolute top-0 end-0 m-3 badge bg-primary fs-6">Users</span>
                            <div class="card-body text-center text-white">
                                <div class="mb-3">
                                    <i class="bi bi-people display-3"></i>
                                </div>
                                <h5 class="card-title fw-semibold">Total Customer</h5>
                                <p class="card-text display-5 fw-bold">{{ $customerCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-lg rounded-4 position-relative overflow-hidden" style="background: linear-gradient(120deg, #28a745 70%, #7be495 100%);">
                            <span class="position-absolute top-0 end-0 m-3 badge bg-success fs-6">Tickets</span>
                            <div class="card-body text-center text-white">
                                <div class="mb-3">
                                    <i class="bi bi-ticket-perforated display-3"></i>
                                </div>
                                <h5 class="card-title fw-semibold">Total Tickets</h5>
                                <p class="card-text display-5 fw-bold">{{ $ticketCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-lg rounded-4 position-relative overflow-hidden" style="background: linear-gradient(120deg, #17a2b8 70%, #63c7e6 100%);">
                            <span class="position-absolute top-0 end-0 m-3 badge bg-info fs-6">Pending</span>
                            <div class="card-body text-center text-white">
                                <div class="mb-3">
                                    <i class="bi bi-clock-history display-3"></i>
                                </div>
                                <h5 class="card-title fw-semibold">Pending Tickets</h5>
                                <p class="card-text display-5 fw-bold">{{ $pendingTickets }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="card border-0 shadow rounded-4">
                        <div class="card-body">
                            @include('charts.overview')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
