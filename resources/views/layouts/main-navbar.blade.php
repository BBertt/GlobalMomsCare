<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container-fluid">
        <!-- Brand on the left -->
        <a class="navbar-brand fw-bold text-danger" href="{{ route('home') }}">GlobalMomsCare</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="/">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="/forums">Forums</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="#">Pregnancy Calendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="#">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold mr-3" href="#">About Us</a>
                </li>
                <!-- Conditional Login or User Info -->
                @if (Auth::check())
                    <!-- User is logged in, show their name with white text and red background -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white bg-danger fw-semibold px-3 py-2 rounded" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- User is not logged in, show login button -->
                    <li class="nav-item ms-3">
                        <a class="btn btn-danger text-white px-4 py-2" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
