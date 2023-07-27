<nav class="navbar fixed-top navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <div class="col-auto mr-auto">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate" width="50px">
            <a class="navbar-brand logo-navbar align-middle" href="{{ route('home') }}">KPOP SOULMATE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-auto">
            <div class="collapse navbar-collapse float-right" id="navbarNav">
                <ul class="navbar-nav">
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
                    <li class="nav-item">
                        <a class="nav-link {{ $active === 'categories' ? 'active' : '' }}" href="#">AI Model
                            <span class="badge mini-badge align-top">New</span></a>
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
                                <li><a class="dropdown-item" href="/dashboard"><i
                                            class="bi bi-layout-text-sidebar-reverse"></i>
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
                            <a href="/login" class="nav-link {{ $active === 'login' ? 'active' : '' }}"><i
                                    class="las la-sign-in-alt"></i> Login</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
