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

    <link href="{{ mix('/css/main.css') }}" rel="stylesheet" />
    <link href="{{ mix('/css/navbar.css') }}" rel="stylesheet" />
</head>

<body>
    @yield('container')

    <script>
        btnLogout.addEventListener("click", function(event) {
            event.preventDefault();

            async function myFunction() {
                const isConfirmed = await msgQuestion("Logout?", "Anda akan keluar dari aplikasi.", "question");

                if (isConfirmed) {
                    window.location.href = btnLogout.getAttribute("data-logout-url");
                }
            }

            myFunction();
        });
    </script>
</body>

</html>
