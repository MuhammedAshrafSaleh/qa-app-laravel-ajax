<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('dist/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/app.css') }}">
    <style>
        * {
            direction: rtl;
        }
        *{
            font-family: 'Cairo', sans-serif;
        }
        /* p,
        span,
        a,
        button,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {

            text-align: right;
        } */

        label {
            font-weight: bold;
        }

        .modal-header .btn-close {
            margin: -0.5rem -0.5rem auto -0.5rem !important;
        }

        .dataTables_filter {
            display: flex;
            justify-content: flex-end;
        }
    </style>
    @yield('css')
</head>

<body class="bg-light">
    @yield('content')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="{{ url('dist/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('dist/js/owl.carousel.min.js') }}"></script>
       <script src="{{ url('dist/js/app.js') }}"></script>

    @yield('js')
</body>

</html>
