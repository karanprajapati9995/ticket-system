<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            🎟️ Ticket System
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" 
                       href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tickets.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('tickets.index') }}">
                        Tickets
                    </a>
                </li>
            </ul>

            <!-- Right side: User name + Logout -->
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>