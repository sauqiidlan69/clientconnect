@extends('layouts.app')

@push('styles')
<style>
    .admin-panel {
        background-color: #f9f9f9;
        min-height: 100vh;
    }
    
    /* Desktop Layout */
    @media (min-width: 768px) {
        .admin-main-content {
            margin-left: 0;
            padding-left: 2rem;
        }
    }
    
    /* Mobile Layout */
    @media (max-width: 767.98px) {
        .admin-main-content {
            margin-left: 0;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 80px; /* Space for mobile menu button */
        }
        
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }
    }
    
    /* Content wrapper for smooth transitions */
    .admin-content-wrapper {
        transition: all 0.3s ease;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 1rem 0;
        overflow: hidden;
    }
    
    /* Enhanced admin panel styling */
    .admin-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 0;
        margin-bottom: 1rem;
    }
    
    .admin-title {
        color: #495057;
        font-weight: 600;
        margin: 0;
    }
    
    .admin-breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        font-size: 0.875rem;
    }
    
    .admin-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="admin-panel">
    <div class="container-fluid">
        <div class="row">
            @include('components.admin_sidebar')
            
            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto admin-main-content">
                <div class="admin-content-wrapper">
                    <!-- Admin Header -->
                    <div class="admin-header px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="admin-title">@yield('page-title', 'Admin Dashboard')</h4>
                                @hasSection('breadcrumb')
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb admin-breadcrumb">
                                            @yield('breadcrumb')
                                        </ol>
                                    </nav>
                                @endif
                            </div>
                            <div class="admin-actions">
                                @yield('page-actions')
                            </div>
                        </div>
                    </div>
                    
                    <!-- Main Content Area -->
                    <div class="px-4 pb-4">
                        @yield('admin-content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
