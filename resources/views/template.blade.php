<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswaku</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap_452/css/bootstrap.min.css') }}">
     <!-- <link href="{{ asset('bootstrap-3.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet"> -->

    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="fluid-container bg-light">
        <div class="container">
        @include('navbar')
    </div>
    </div>
    <div class="container mt-4">
        @yield('main')
    </div>

    @yield('footer')

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-2.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap_452/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/siswakuapp.js') }}"></script>

</body>

</html>