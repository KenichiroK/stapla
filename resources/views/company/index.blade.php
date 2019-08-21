<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    @yield('assets')
</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <p class="control serch-wrp">
                    <input type="text" placeholder="Search transactions, invoices or help" class="search input"> 
                    <span class="icon"><img src="../../../images/searchicon.png" alt="serch"></span>
                </p>

                <div id="navbarHomeHeader" class="navbar-menu">
                    <div class="navbar-end">
                        <ul class="icon-wrp">
                            <li class="sup">
                                <a><img src="../../../images/icon_support.png" alt="serch"></a>
                            </li>
                            <li class="not">
                                <a><img src="../../../images/icon_notification.png" alt="serch"></a>
                            </li>
                        </ul>
                        @yield('header-profile')
                    </div>
                </div>
            </nav>
        </header>      

        <main>
            <div class="sidebar-wrapper">
                @yield('sidebar')
            </div>

            <div class="content-wrapper">
            @yield('content')
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
