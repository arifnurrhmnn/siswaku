<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}"><strong>SISWAKU</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {{-- Siswa --}}
            @if (!empty($halaman) && $halaman == 'siswa')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('siswa') }}">Siswa<span class="sr-only">(current)</span></a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('siswa') }}">Siswa</a>
                </li>
            @endif

            {{-- Kelas --}}
            @if (Auth::check())
                @if (!empty($halaman) && $halaman == 'kelas')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('kelas') }}">Kelas<span class="sr-only">(current)</span></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('kelas') }}">Kelas</a>
                    </li>
                @endif
            @endif

            {{-- Hobi --}}
            @if (Auth::check())
                @if (!empty($halaman) && $halaman == 'hobi')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('hobi') }}">Hobi<span class="sr-only">(current)</span></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('hobi') }}">Hobi</a>
                    </li>
                @endif
            @endif

            {{-- About --}}
            @if (!empty($halaman) && $halaman == 'about')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('about') }}">About<span class="sr-only">(current)</span></a>
                </li>
            @else
                <li class="nav-item">
                    <a class=" nav-link" href="{{ url('about') }}">About</a>
                </li>
            @endif

            {{-- User --}}
            @if (Auth::check() && Auth::user()->level == 'admin')
                 @if (!empty($halaman) && $halaman == 'user')
                    <li class="active">
                        <a class="nav-link" href="{{ url('user') }}">User<span class="sr-only">(current)</span></a>
                    <li>
                @else
                    <li>
                        <a class="nav-link" href="{{ url('user') }}">User</a>
                    </li>
                @endif
            @endif
        </ul>

        {{-- Link Login / Logout --}}
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
        </ul>
        {{-- /.logout link --}}
    </div>
</nav>