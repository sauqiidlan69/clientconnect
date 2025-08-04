<!-- Mobile Menu Toggle Button -->
<button class="btn btn-primary d-md-none position-fixed mobile-menu-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar" style="top: 20px; left: 20px; z-index: 1050;">
    <i class="bi bi-list fs-5"></i>
</button>

<!-- Sidebar for Desktop -->
<nav class="col-md-2 d-none d-md-block bg-white sidebar py-4 rounded-end-4 shadow-lg border-end">
    <div class="position-sticky">
        <div class="sidebar-header mb-4 px-3">
            <h6 class="text-primary fw-bold mb-0">
                <i class="bi bi-speedometer2 me-2"></i>Admin Panel
            </h6>
        </div>
        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door me-2 fs-5"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.support.*') ? 'active fw-bold text-success bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.support.index') }}">
                    <i class="bi bi-headset me-2 fs-5"></i> <span>Manage Support</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.customers.*') ? 'active fw-bold text-info bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.customers.index') }}">
                    <i class="bi bi-person-badge me-2 fs-5"></i> <span>Manage Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.tickets.*') ? 'active fw-bold text-warning bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.tickets.index') }}">
                    <i class="bi bi-ticket-detailed me-2 fs-5"></i> <span>Manage Tickets</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center {{ request()->routeIs('admin.reports.*') ? 'active fw-bold text-success bg-light shadow-sm' : 'text-secondary' }}" href="{{ route('admin.reports.index') }}">
                    <i class="bi bi-graph-up me-2 fs-5"></i> <span>Reports & Analytics</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
    <!--<div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title fw-bold" id="adminSidebarLabel">
            <i class="bi bi-speedometer2 me-2"></i>Admin Panel
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>-->
    <div class="offcanvas-body p-0">
        <div class="mobile-sidebar-content">
            <!-- User Info Section -->
            <div class="user-info-mobile p-3 bg-light border-bottom">
                <div class="d-flex align-items-center">
                    <div class="avatar-mobile me-3">
                        <i class="bi bi-person-circle fs-2 text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                        <small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Links -->
            <ul class="nav flex-column mobile-nav">
                <li class="nav-item">
                    <a class="nav-link mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}" 
                       onclick="handleMobileNavClick(this)">
                        <i class="bi bi-house-door me-3 fs-5"></i>
                        <span>Dashboard</span>
                        @if(request()->routeIs('admin.dashboard'))
                            <i class="bi bi-chevron-right ms-auto"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mobile-nav-link {{ request()->routeIs('admin.support.*') ? 'active' : '' }}" 
                       href="{{ route('admin.support.index') }}" 
                       onclick="handleMobileNavClick(this)">
                        <i class="bi bi-headset me-3 fs-5"></i>
                        <span>Manage Support</span>
                        @if(request()->routeIs('admin.support.*'))
                            <i class="bi bi-chevron-right ms-auto"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mobile-nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" 
                       href="{{ route('admin.customers.index') }}" 
                       onclick="handleMobileNavClick(this)">
                        <i class="bi bi-person-badge me-3 fs-5"></i>
                        <span>Manage Customers</span>
                        @if(request()->routeIs('admin.customers.*'))
                            <i class="bi bi-chevron-right ms-auto"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mobile-nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}" 
                       href="{{ route('admin.tickets.index') }}" 
                       onclick="handleMobileNavClick(this)">
                        <i class="bi bi-ticket-detailed me-3 fs-5"></i>
                        <span>Manage Tickets</span>
                        @if(request()->routeIs('admin.tickets.*'))
                            <i class="bi bi-chevron-right ms-auto"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mobile-nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                       href="{{ route('admin.reports.index') }}" 
                       onclick="handleMobileNavClick(this)">
                        <i class="bi bi-graph-up me-3 fs-5"></i>
                        <span>Reports & Analytics</span>
                        @if(request()->routeIs('admin.reports.*'))
                            <i class="bi bi-chevron-right ms-auto"></i>
                        @endif
                    </a>
                </li>
            </ul>
            
            <!-- Quick Actions 
            <div class="mobile-quick-actions p-3 border-top mt-auto">
                <h6 class="text-muted mb-3 fw-bold">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary btn-sm" data-bs-dismiss="offcanvas">
                        <i class="bi bi-plus-circle me-2"></i>New Ticket
                    </a>
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-outline-primary btn-sm" data-bs-dismiss="offcanvas">
                        <i class="bi bi-person-plus me-2"></i>New Customer
                    </a>
                </div>
            </div>-->
        </div>
    </div>
</div>

<style>
/* Mobile Menu Toggle Button */
.mobile-menu-toggle {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    transition: all 0.3s ease;
}

.mobile-menu-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

/* Desktop Sidebar Enhancements */
.sidebar .nav-link {
    transition: all 0.3s ease;
    margin-bottom: 0.25rem;
}

.sidebar .nav-link:hover {
    transform: translateX(5px);
    background-color: #f8f9fa !important;
    color: #0d6efd !important;
}

.sidebar .nav-link.active {
    position: relative;
    overflow: hidden;
}

.sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, #0d6efd, #6610f2);
}

.sidebar-header {
    border-bottom: 2px solid #e9ecef;
    position: relative;
}

.sidebar-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: linear-gradient(to right, #0d6efd, #6610f2);
}

/* Mobile Offcanvas Styles */
.offcanvas {
    width: 280px !important;
}

.mobile-sidebar-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.user-info-mobile {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.avatar-mobile {
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-nav {
    flex: 1;
    padding: 1rem 0;
}

.mobile-nav-link {
    padding: 1rem 1.5rem;
    border: none;
    color: #6c757d;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
}

.mobile-nav-link:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
    transform: translateX(5px);
}

.mobile-nav-link.active {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    color: #0d6efd;
    font-weight: 600;
    border-left: 4px solid #0d6efd;
}

.mobile-nav-link.active::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 8px 0 8px 12px;
    border-color: transparent transparent transparent #0d6efd;
}

.mobile-quick-actions {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Animations */
@keyframes slideInLeft {
    from {
        transform: translateX(-100%);
    }
    to {
        transform: translateX(0);
    }
}

.offcanvas.show {
    animation: slideInLeft 0.3s ease-out;
}

/* Enhanced Button Styles */
.mobile-quick-actions .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.mobile-quick-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Responsive Adjustments */
@media (max-width: 767.98px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .mobile-menu-toggle {
        position: fixed !important;
        top: 15px !important;
        left: 15px !important;
        z-index: 1060 !important;
    }
}

/* Backdrop Enhancement */
.offcanvas-backdrop {
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(3px);
}
</style>

<script>
function handleMobileNavClick(element) {
    // Add loading state to the clicked link
    const originalHtml = element.innerHTML;
    element.innerHTML = '<i class="bi bi-arrow-repeat me-3 fs-5"></i><span>Loading...</span>';
    element.style.pointerEvents = 'none';
    
    // Close the offcanvas
    const offcanvas = document.getElementById('adminSidebar');
    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
    if (bsOffcanvas) {
        bsOffcanvas.hide();
    }
    
    // Navigate after a short delay to ensure offcanvas closes
    setTimeout(() => {
        window.location.href = element.getAttribute('href');
    }, 150);
    
    // Reset the link after navigation (in case navigation fails)
    setTimeout(() => {
        element.innerHTML = originalHtml;
        element.style.pointerEvents = 'auto';
    }, 3000);
}

// Ensure offcanvas closes when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const offcanvasElement = document.getElementById('adminSidebar');
    if (offcanvasElement) {
        offcanvasElement.addEventListener('hidden.bs.offcanvas', function () {
            // Reset any loading states when offcanvas is hidden
            const loadingLinks = document.querySelectorAll('.mobile-nav-link[style*="pointer-events: none"]');
            loadingLinks.forEach(link => {
                link.style.pointerEvents = 'auto';
            });
        });
    }
});
</script>