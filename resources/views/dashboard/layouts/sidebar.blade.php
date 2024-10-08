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
            @if (auth()->user()->profile_picture === null)
                <img src="{{ asset('img/user-default.png') }}" alt="{{ auth()->user()->name }} avatar" class="img-square">
            @elseif (str_starts_with(auth()->user()->profile_picture, 'https://lh3.googleusercontent.com'))
                <img src="{{ auth()->user()->profile_picture }}" alt="{{ auth()->user()->name }} avatar">
            @else
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }} avatar"
                    class="img-square">
            @endif
            <div class="user-name my-3">
                <h6 class="fw-semibold text-white">{{ auth()->user()->name }}</h6>
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
                {{-- <li>
                    <a href="" class="menu-nav">
                        <i class="las la-photo-video"></i>
                        Exclusive Video
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('my-request') }}" class="menu-nav">
                        <i class="las la-list-alt"></i>
                        My Request
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="menu-nav">
                        <i class="las la-user-circle"></i>
                        Profile
                    </a>
                </li>
            </ul>

            <div class="menu-head">
                <p>Table</p>
            </div>
            <ul>
                <li>
                    <a href="{{ route('ai-models.index') }}"
                        class="menu-nav {{ Request::is('dashboard/ai-models*') ? 'text-active' : '' }}">
                        <i class="las la-user-clock"></i>
                        AI Model
                    </a>
                </li>
                <li>
                    <a href="{{ route('albums.index') }}"
                        class="menu-nav {{ Request::is('dashboard/albums*') ? 'text-active' : '' }}">
                        <i class="las la-compact-disc"></i>
                        Albums
                    </a>
                </li>
                <li>
                    <a href="{{ route('album-artist.index') }}"
                        class="menu-nav {{ Request::is('dashboard/album-artist') ? 'text-active' : '' }}">
                        <i class="las la-user-friends"></i>
                        Album Artist
                    </a>
                </li>
                <li>
                    <a href="{{ route('artists.index') }}"
                        class="menu-nav {{ Request::is('dashboard/artists*') ? 'text-active' : '' }}">
                        <i class="las la-user"></i>
                        Artists
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="menu-nav {{ Request::is('dashboard/categories*') ? 'text-active' : '' }}">
                        <i class="las la-project-diagram"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('companies.index') }}"
                        class="menu-nav {{ Request::is('dashboard/companies*') ? 'text-active' : '' }}">
                        <i class="las la-building"></i>
                        Companies
                    </a>
                </li>
                <li>
                    <a href="{{ route('genres.index') }}"
                        class="menu-nav {{ Request::is('dashboard/genres*') ? 'text-active' : '' }}">
                        <i class="las la-list"></i>
                        Genre
                    </a>
                </li>
                <li>
                    <a href="{{ route('idols.index') }}"
                        class="menu-nav {{ Request::is('dashboard/idols*') ? 'text-active' : '' }}">
                        <i class="las la-user-astronaut"></i>
                        Idols
                    </a>
                </li>
                <li>
                    <a href="{{ route('member-group.index') }}"
                        class="menu-nav {{ Request::is('dashboard/member-group*') ? 'text-active' : '' }}">
                        <i class="las la-users"></i>
                        Member Group
                    </a>
                </li>
                <li>
                    <a href="{{ route('playlists.index') }}"
                        class="menu-nav {{ Request::is('dashboard/playlists*') ? 'text-active' : '' }}">
                        <i class="las la-play-circle"></i>
                        Playlists
                    </a>
                </li>
                <li>
                    <a href="{{ route('playlist-project.index') }}"
                        class="menu-nav {{ Request::is('dashboard/playlist-project*') ? 'text-active' : '' }}">
                        <i class="las la-photo-video"></i>
                        Playlist Project
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}"
                        class="menu-nav {{ Request::is('dashboard/projects*') ? 'text-active' : '' }}">
                        <i class="las la-chalkboard"></i>
                        Projects
                    </a>
                </li>
                <li>
                    <a href="{{ route('project-artist.index') }}"
                        class="menu-nav {{ Request::is('dashboard/project-artist') ? 'text-active' : '' }}">
                        <i class="las la-user-friends"></i>
                        Project Artist
                    </a>
                </li>
                <li>
                    <a href="{{ route('project-types.index') }}"
                        class="menu-nav {{ Request::is('dashboard/project-types*') ? 'text-active' : '' }}">
                        <i class="las la-project-diagram"></i>
                        Projects Types
                    </a>
                </li>
                <li>
                    <a href="{{ route('songs.index') }}"
                        class="menu-nav {{ Request::is('dashboard/songs*') ? 'text-active' : '' }}">
                        <i class="las la-music"></i>
                        Songs
                    </a>
                </li>
                <li>
                    <a href="{{ route('song-artist.index') }}"
                        class="menu-nav {{ Request::is('dashboard/song-artist') ? 'text-active' : '' }}">
                        <i class="las la-user-friends"></i>
                        Song Artist
                    </a>
                </li>
                <li>
                    <a href="{{ route('song-genre.index') }}"
                        class="menu-nav {{ Request::is('dashboard/song-genre*') ? 'text-active' : '' }}">
                        <i class="las la-music"></i>
                        Song Genre
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
