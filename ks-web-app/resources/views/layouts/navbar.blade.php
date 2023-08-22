<nav class="navbar sticky-top navbar-expand-lg bg-color-secondary d-none d-sm-flex shadow-sm">
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
                    <a class="nav-link {{ $active === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'projects' ? 'active' : '' }}"
                        href="{{ route('projects') }}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'gallery' ? 'active' : '' }}"
                        href="{{ route('gallery') }}">Gallery</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Other Menu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fs-6 {{ $active === 'ai_model' ? 'active' : '' }}" href="#">AI
                                model <span class="badge mini-badge align-top">New</span></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item fs-6" href="#">Exclusive Video</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'request_list' ? 'active' : '' }}"
                        href="{{ route('request-list') }}">Request List</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hello {{ auth()->user()->name }} !
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">
                                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ $active === 'login' ? 'active' : '' }}"><i
                                class="las la-sign-in-alt"></i> Login</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

<header class="bg-color-secondary p-3 d-xs-block d-sm-none">
    <div class="brand">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate" width="50px" class=" align-middle">
        <a class="navbar-brand logo-navbar align-middle" href="{{ route('home') }}">KPOP SOULMATE</a>
    </div>
</header>

{{-- Nav Mobile --}}
<nav class="navbar fixed-bottom bg-color-secondary mobile-nav shadow">
    <div id="mobile-menu" class="content-mobile-menu shadow">
        <a href="" class="text-decoration-none d-flex">
            <i class='bx bxs-user-voice bx-xs'></i>
            <span class="mx-2">AI Model</span>
        </a>
        <a href="" class="text-decoration-none d-flex">
            <i class='bx bxs-videos bx-xs'></i>
            <span class="mx-2"> Exclusive Video</span>
        </a>
        <a href="{{ route('login') }}" class="text-decoration-none d-flex">
            <i class='bx bx-log-in-circle bx-xs'></i>
            <span class="mx-2"> Login</span>
        </a>
    </div>
    <div class="d-flex py-2 m-0 align-items-center justify-content-evenly nav-link-mobile">
        @php
            $isHome = false;
            $isGallery = false;
            $isProjects = false;
            $isRequestList = false;
            
            if ($active === 'home') {
                $isHome = true;
            } elseif ($active === 'projects') {
                $isProjects = true;
            } elseif ($active === 'gallery') {
                $isGallery = true;
            } elseif ($active === 'request_list') {
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
