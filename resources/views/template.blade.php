<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswaku</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap_452/css/bootstrap.min.css') }}">

    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">
        @include('navbar')
        @yield('main')
    </div>

    @yield('footer')

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap_452/js/bootstrap.min.js') }}"></script>

</body>

</html>