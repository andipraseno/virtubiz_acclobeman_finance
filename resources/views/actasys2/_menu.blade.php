<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
            <img src="{{ url('/storage/company/' . Session::get('actasys_company_id') . '.png') }}" alt="Neomi Service"
                width="50" height="50" class="me-2">
            <h3 class="text-secondary mb-0">{{ Session::get('actasys_company_kode') }}</h3>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark"
            aria-controls="offcanvasNavbarDark" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end text-bg-light rounded" tabindex="-1" id="offcanvasNavbarDark"
            aria-labelledby="offcanvasNavbarDarkLabel">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">{{ config('app.software.nama') }}</h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ $menu_id == 1 ? 'active' : '' }}" aria-current="page"
                            href="{{ url('/dashboard') }}">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $menu_id == 2 ? 'active' : '' }}" href="#"
                            id="navbarDropdownLevel" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-stickies"></i> Level
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownLevel">
                            <li><a class="dropdown-item" href="{{ url('/master/level1') }}">Level 1</a></li>
                            <li><a class="dropdown-item" href="{{ url('/master/level2') }}">Level 2</a></li>
                            <li><a class="dropdown-item" href="{{ url('/master/level3') }}">Level 3</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $menu_id == 3 ? 'active' : '' }}" href="{{ url('/master/akun') }}">
                            <i class="bi bi-postcard"></i> Account
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $menu_id == 4 ? 'active' : '' }}"
                            href="{{ url('/master/costcenter') }}">
                            <i class="bi bi-tropical-storm"></i> Cost Center
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logout-link">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
