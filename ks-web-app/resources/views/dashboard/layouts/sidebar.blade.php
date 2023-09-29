<nav class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-flex text-uppercase">
            <a href="{{ route('home') }}">
                Kpop Soulmate
            </a>
        </div>
    </div>

    <div class="sidebar-main">
        <div class="sidebar-user">
            <img src="{{ asset('img/user-default.png') }}" alt="" class="">
            <div class="user-name my-3">
                <h6 class="fw-semibold">{{ auth()->user()->name }}</h6>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-head">
                <p>Dashboard</p>
            </div>
            <ul class="table-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'text-active' : '' }}">
                        <i class="la la-chart-pie"></i>
                        Analytics
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="menu-nav">
                        <i class="las la-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects') }}" class="menu-nav">
                        <i class="las la-calendar"></i>
                        Projects
                    </a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}" class="menu-nav">
                        <i class="las la-icons"></i>
                        Gallery
                    </a>
                </li>
                {{-- <li>
                    <a href="birthday" class="menu-nav">
                        <i class="las la-birthday-cake"></i>
                        Birthday
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('request-list') }}" class="menu-nav">
                        <i class="las la-clipboard-list"></i>
                        Request List
                    </a>
                </li>
                <li>
                    <a href="{{ route('ai-model') }}" class="menu-nav">
                        <i class="las la-user-clock"></i>
                        AI Model
                    </a>
                </li>
                <li>
                    <a href="" class="menu-nav">
                        <i class="las la-photo-video"></i>
                        Exclusive Video
                    </a>
                </li>
            </ul>

            <div class="menu-head">
                <p>Table</p>
            </div>
            <ul>
                <li>
                    <a href="/dashboard/albums"
                        class="menu-nav {{ Request::is('dashboard/albums') ? 'text-active' : '' }}">
                        <i class="las la-compact-disc"></i>
                        Albums
                    </a>
                </li>
                <li>
                    <a href="/dashboard/album-songs"
                        class="menu-nav {{ Request::is('dashboard/album-songs') ? 'text-active' : '' }}">
                        <i class="las la-compact-disc"></i>
                        Albums Songs
                    </a>
                </li>
                <li>
                    <a href="/dashboard/artists"
                        class="menu-nav {{ Request::is('dashboard/artists*') ? 'text-active' : '' }}">
                        <i class="las la-user"></i>
                        Artists
                    </a>
                </li>
                <li>
                    <a href="/dashboard/ai-models"
                        class="menu-nav {{ Request::is('dashboard/ai-models*') ? 'text-active' : '' }}">
                        <i class="las la-user-clock"></i>
                        AI Model
                    </a>
                </li>
                <li>
                    <a href="/dashboard/categories"
                        class="menu-nav {{ Request::is('dashboard/categories*') ? 'text-active' : '' }}">
                        <i class="las la-project-diagram"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="/dashboard/projects"
                        class="menu-nav {{ Request::is('dashboard/projects*') ? 'text-active' : '' }}">
                        <i class="las la-chalkboard"></i>
                        Projects
                    </a>
                </li>
                <li>
                    <a href="/dashboard/project-types"
                        class="menu-nav {{ Request::is('dashboard/project-types*') ? 'text-active' : '' }}">
                        <i class="las la-project-diagram"></i>
                        Projects Types
                    </a>
                </li>
                <li>
                    <a href="/dashboard/songs"
                        class="menu-nav {{ Request::is('dashboard/songs*') ? 'text-active' : '' }}">
                        <i class="las la-music"></i>
                        Songs
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Keluar?')"
                            class="border-0 bg-transparent">
                            <i class="las la-sign-out-alt">
                            </i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
