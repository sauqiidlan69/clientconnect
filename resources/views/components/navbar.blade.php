<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-lg py-3" style="background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 d-flex align-items-center text-dark" href="{{ url('/') }}">
            <span class="text-dark">ClientConnect</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            @auth
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2 text-dark"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    @if(auth()->user()->role === 'admin')
                        <a class="nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="{{ route('admin.tickets.index') }}">
                            <i class="bi bi-ticket-perforated me-2 text-dark"></i>Tickets
                        </a>
                    @elseif(auth()->user()->role === 'support')
                        <a class="nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="{{ route('support.tickets.index') }}">
                            <i class="bi bi-ticket-perforated me-2 text-dark"></i>Tickets
                        </a>
                    @elseif(auth()->user()->role === 'customer')
                        <a class="nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="{{ route('customer.tickets.index') }}">
                            <i class="bi bi-ticket-perforated me-2 text-dark"></i>My Tickets
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="{{ route('profile.show') }}">
                        <i class="bi bi-person-circle me-2 text-dark"></i>Profile
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-link nav-link px-3 rounded-pill fw-semibold d-flex align-items-center text-danger" type="submit">
                            <i class="bi bi-box-arrow-right me-2 text-danger"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 rounded-pill fw-semibold d-flex align-items-center text-dark" href="#" id="navbarLoginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box-arrow-in-right me-2 text-dark"></i>Login
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarLoginDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-dark" href="{{ route('login.customer') }}">
                                <i class="bi bi-person me-2 text-dark"></i>Customer Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-dark" href="{{ route('login.admin') }}">
                                <i class="bi bi-shield-lock me-2 text-dark"></i>Admin Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-dark" href="{{ route('login.support') }}">
                                <i class="bi bi-headset me-2 text-dark"></i>Support Login
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light ms-2 px-4 py-2 rounded-pill fw-semibold shadow-sm d-flex align-items-center text-dark" href="{{ route('register') }}">
                        <i class="bi bi-pencil-square me-2 text-dark"></i>Register
                    </a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
