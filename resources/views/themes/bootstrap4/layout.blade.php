<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('themes/bootstrap4/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('themes/bootstrap4/assets/css/modern-business.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    @include('themes.bootstrap4.partials.navbar')

    <!-- Page Content -->
    @yield('content')
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark" style="clear: both;">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('themes/bootstrap4/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('themes/bootstrap4/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
