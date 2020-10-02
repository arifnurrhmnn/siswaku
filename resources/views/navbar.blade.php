<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">SiswakuApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if (!empty($halaman) && $halaman == 'siswa')
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('siswa') }}">Siswa<span class="sr-only">(current)</span></a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ url('siswa') }}">Siswa</a>
            </li>
            @endif

            @if (!empty($halaman) && $halaman == 'about')
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('about') }}">About<span class="sr-only">(current)</span></a>
            </li>
            @else
            <li class="nav-item">
                <a class=" nav-link" href="{{ url('about') }}">About</a>
            </li>
            @endif
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
        </form>
    </div>
</nav>