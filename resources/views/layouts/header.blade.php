<nav class="navbar navbar-expand-lg navbar-light bg-blue-400" aria-label="Fifth navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Smart Teaching</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample05" style="">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item justify-content-md-end">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
