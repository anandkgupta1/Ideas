@include('partials.profile_popup')

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary"
     data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/">
            <span class="fas fa-brain me-1"></span>
            @if (Auth::check())
                {{ Auth::user()->name }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="nav-link" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link" style="font-family: 'Cabin Sketch', cursive; font-weight: 600;">Logout</button>
                        </form>
                    </li>
                    <!-- Profile Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="openPopup(event);">Profile</a>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
