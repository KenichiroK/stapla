<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Impro</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ env('AWS_URL') }}/common/favicon.ico">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    @yield('assets')
</head>
<body>
    <div>
        @yield('content')
    </div>
    <!-- Scripts -->
    @yield('asset-js')
</body>
</html>