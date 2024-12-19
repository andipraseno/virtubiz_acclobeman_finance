<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.software.nama') }}</title>
    <meta name="author" content="andipraseno@gmail.com">
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="shortcut icon" href="{{ mix('/images/app-icon.ico') }}">
    <link rel="apple-touch-icon" href="{{ mix('/images/app-icon.ico') }}">

    {{-- css --}}
    <link href="{{ url('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

    <link href="{{ mix('css/main.css') }}" rel="stylesheet" />
</head>

<body class="d-flex justify-content-center align-items-center">
    @yield('container')
</body>

</html>
