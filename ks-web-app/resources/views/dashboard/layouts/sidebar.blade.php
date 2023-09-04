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
            <div class="user-name rounded-pill my-3">
                <span class="fs-12">{{ auth()->user()->name }}</span>
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
            </ul>

            <div class="menu-head">
                <p>Table</p>
            </div>
            <ul>
                <li>
                    <a href="" class="menu-nav">
                        <i class="las la-compact-disc"></i>
                        Albums
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
                    <a href="" class="menu-nav">
                        <i class="las la-user-clock"></i>
                        AI Model
                    </a>
                </li>
                <li>
                    <a href="" class="menu-nav">
                        <i class="las la-project-diagram"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="" class="menu-nav">
                        <i class="las la-photo-video"></i>
                        Exclusive Video
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
                    <a href="" class="menu-nav">
                        <i class="las la-project-diagram"></i>
                        Projects Types
                    </a>
                </li>
                <li>
                    <a href="" class="menu-nav">
                        <i class="las la-music"></i>
                        Songs Album
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
