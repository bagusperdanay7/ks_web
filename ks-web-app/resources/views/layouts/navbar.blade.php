<nav class="navbar sticky-top navbar-expand-lg bg-second d-none d-sm-flex shadow-sm" aria-label="Navbar Desktop Mode">
    <div class="container">
        <div class="brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate" width="50px" class=" align-middle">
            <a class="navbar-brand logo-navbar align-middle" href="{{ route('home') }}">KPOP SOULMATE</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav text-center text-start">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('projects*') ? 'active' : '' }}"
                        href="{{ route('projects') }}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('gallery*') ? 'active' : '' }}"
                        href="{{ route('gallery') }}">Gallery</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Other Menu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fs-14 {{ Request::is('/ai-model') ? 'active' : '' }}"
                                href="{{ route('ai-model') }}">AI
                                model
                            </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item fs-14" href="#">Exclusive Video</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('request-list') ? 'active' : '' }}"
                        href="{{ route('request-list') }}">Request List</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        @if (auth()->user()->profile_picture === null)
                            <img src="{{ asset('img/user-default.png') }}" class="rounded-circle img-square nav-link dropdown-toggle"
                                alt="User Picture" id="profileDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" width="45px">
                        @elseif (str_starts_with(auth()->user()->profile_picture, 'https://lh3.googleusercontent.com'))
                            <img src="{{ auth()->user()->profile_picture }}"
                                class="rounded-circle  nav-link dropdown-toggle" alt="User Picture"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                width="45px">
                        @else
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                class="rounded-circle img-square nav-link dropdown-toggle" alt="User Picture"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                width="45px">
                        @endif
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            @can('admin')
                                <li>
                                    <a class="dropdown-item fs-14 fw-normal" href="/dashboard">
                                        <i class="las la-columns d-inline"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a class="dropdown-item fs-14 fw-normal" href="{{ route('profile') }}">
                                    <i class="las la-user-circle"></i>
                                    Profile
                                </a>
                            </li>
                            <li class="fs-14">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="las la-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}"><i
                                class="las la-sign-in-alt"></i> Login</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

<header class="bg-second p-3 d-xs-block d-sm-none">
    <div class="brand">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate" width="50px" class=" align-middle">
        <a class="navbar-brand logo-navbar align-middle" href="{{ route('home') }}">KPOP SOULMATE</a>
    </div>
</header>

{{-- Nav Mobile --}}
<!-- TODO: Menu Diganti Profile, Request List diganti ke menu -->
<nav class="navbar fixed-bottom bg-second mobile-nav shadow" aria-label="Navbar Mobile Only">
    <div id="mobile-menu" class="content-mobile-menu shadow">
        <a href="{{ route('ai-model') }}" class="text-decoration-none d-flex">
            <i class='bx bxs-user-voice bx-xs'></i>
            <span class="mx-2">AI Model</span>
        </a>
        <a href="" class="text-decoration-none d-flex">
            <i class='bx bxs-videos bx-xs'></i>
            <span class="mx-2">Exclusive Video</span>
        </a>
        @auth
            @can('admin')
                <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex">
                    <i class='bx bxs-dashboard bx-xs'></i>
                    <span class="mx-2">Dashboard</span>
                </a>
            @endcan
            <a href="{{ route('profile') }}" class="text-decoration-none d-flex">
                <i class='bx bxs-user-circle bx-xs'></i>
                <span class="mx-2">Profile</span>
            </a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="bx bx-log-out-circle bx-xs"></i><span class="mx-2 fw-medium align-middle">Logout</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-decoration-none d-flex">
                <i class='bx bx-log-in-circle bx-xs'></i>
                <span class="mx-2">Login</span>
            </a>
        @endauth
    </div>
    <div class="d-flex py-2 m-0 align-items-center justify-content-evenly nav-link-mobile">
        @php
            $isHome = false;
            $isGallery = false;
            $isProjects = false;
            $isRequestList = false;
            
            if (Request::is('/')) {
                $isHome = true;
            } elseif (Request::is('projects*')) {
                $isProjects = true;
            } elseif (Request::is('gallery*')) {
                $isGallery = true;
            } elseif (Request::is('request-list*')) {
                $isRequestList = true;
            }
            
        @endphp
        <div class="text-center">
            <a href="{{ route('home') }}" @class(['text-decoration-none', 'active' => $isHome])>
                <i @class(['bx', 'bxs-home' => $isHome, 'bx-home' => !$isHome, 'bx-sm'])></i>
                <p class="m-0">Home</p>
            </a>
        </div>
        <div class="text-center">
            <a href="{{ route('projects') }}" @class(['text-decoration-none', 'active' => $isProjects])>
                <i @class([
                    'bx',
                    'bxs-notepad' => $isProjects,
                    'bx-notepad' => !$isProjects,
                    'bx-sm',
                ])></i>
                <p class="m-0">Projects</p>
            </a>
        </div>
        <div class="text-center">
            <a href="{{ route('gallery') }}" @class(['text-decoration-none', 'active' => $isGallery])>
                <i @class([
                    'bx',
                    'bxs-image' => $isGallery,
                    'bx-image' => !$isGallery,
                    'bx-sm',
                ])></i>
                <p class="m-0">Gallery</p>
            </a>
        </div>
        <div class="text-center">
            <a href="{{ route('request-list') }}" @class(['text-decoration-none', 'active' => $isRequestList])>
                <i class='bx bx-list-check bx-sm'></i>
                <p class="m-0">Request</p>
            </a>
        </div>
        <div class="text-center mobile-menu">
            <span id="menu-btn-mobile">
                <i class='bx bx-menu bx-sm'></i>
                <p class="m-0">Menu</p>
            </span>
        </div>
    </div>
</nav>
