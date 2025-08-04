@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold text-gradient mb-3" style="background: linear-gradient(90deg,#007bff,#00c6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Welcome to ClientConnect CRM
        </h1>
        <p class="lead text-secondary mb-4">Effortlessly manage your customers, tickets, and teams in one platform.</p>
        @guest
            <div class="d-flex flex-column align-items-center gap-3">
                <div class="row w-100">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <a href="{{ route('login.customer') }}" class="btn btn-primary btn-lg w-100 px-5 shadow-sm">Already a Customer</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg w-100 px-5 shadow-sm">Get Started With Us</a>
                    </div>
                </div>
            </div>
        @endguest
    </div>

    <div class="row g-4 text-center mb-5">
        <div class="col-md-4">
            <div class="card h-100 shadow-lg border-0 bg-light">
                <div class="card-body">
                    <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px; height:70px;">
                        <i class="bi bi-people text-white display-5"></i>
                    </div>
                    <h4 class="fw-semibold mb-2">Customer Management</h4>
                    <p class="text-muted">Organize, search, and interact with customers easily.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-lg border-0 bg-light">
                <div class="card-body">
                    <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px; height:70px;">
                        <i class="bi bi-ticket-detailed text-white display-5"></i>
                    </div>
                    <h4 class="fw-semibold mb-2">Support Ticketing</h4>
                    <p class="text-muted">Track issues, assign support, and resolve faster.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-lg border-0 bg-light">
                <div class="card-body">
                    <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px; height:70px;">
                        <i class="bi bi-graph-up-arrow text-white display-5"></i>
                    </div>
                    <h4 class="fw-semibold mb-2">Real-Time Reports</h4>
                    <p class="text-muted">Export, view metrics, and make smart decisions.</p>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="alert alert-info shadow-sm d-flex align-items-center gap-3">
                <i class="bi bi-lightbulb display-6 text-primary"></i>
                <span class="fs-5">Tip: Try our demo to explore features before signing up!</span>
                <a href="#" class="btn btn-outline-primary btn-sm ms-auto">Live Demo</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-3 text-primary">Why Choose ClientConnect CRM?</h3>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Modern, intuitive interface</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Secure & reliable platform</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Fast onboarding & support</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Customizable to your needs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>-->

<style>
    body {
        background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);
    }
    .text-gradient {
        background: linear-gradient(90deg,#007bff,#00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
