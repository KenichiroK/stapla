<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Impro</title>

    

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
                    <span class="icon"><img src="{{ asset('images/searchicon.png') }}" alt="serch"></span>
                </p>

                <div id="navbarHomeHeader" class="navbar-menu">
                    <div class="navbar-end">
                        <ul class="icon-wrp">
                            <li class="sup">
                                <a><img src="{{ asset('images/icon_support.png') }}" alt="serch"></a>
                            </li>
                            <li class="not">
                                <a><img src="{{ asset('images/icon_notification.png') }}" alt="serch"></a>
                            </li>
                        </ul>
                        <div class="header-proflie">
                            <div class="option">
                                <div class="user-name">
                                    {{ $partner->name }}
                                </div>

                                <div class="icon-imgbox">
                                    <img src="{{ asset('images/icon_small-down.png') }}" alt="">
                                </div>
                            </div>
                            
                            <div class="optionBox">
                                <div class="balloon">
                                    <ul>
                                        <li><a href="">プロフィール設定</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('partner.logout') }}">
                                                @csrf
                                                <button type="submit">ログアウト</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>

                            <div class="user-imgbox">
                                <a href="{{ route('partner.profile.create') }}">
                                    <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>      

        <main>
            <div class="sidebar-wrapper">
                <div class="sidebar__container">
                    <div class="sidebar__container__wrapper">
                        <aside class="menu menu__container">
                            <a href="/company/dashboard">
                                <div class="menu__container--label">
                                    <div class="menu-label">
                                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                                    </div>
                                </div>
                            </a>
                            <ul class="menu-list menu menu__container__menu-list">
                                <li>
                                    <a href="#">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_home.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            ホーム
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('partner.dashboard') }}" class="{{ strpos(request()->fullUrl(), 'dashboard') ? 'isActive' : '' }}">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_dashboard-active.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            ダッシュボード
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="{{ strpos(request()->fullUrl(), 'project') ? 'isActive' : '' }}">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            プロジェクト
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="{{ strpos(request()->fullUrl(), 'task') ? 'isActive' : '' }}">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            タスク
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="{{ strpos(request()->fullUrl(), 'document') ? 'isActive' : '' }}">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_invoices.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            書類
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            カレンダー
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_help-center.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            ヘルプセンター
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('partner.setting.invoice.create') }}" class="{{ strpos(request()->fullUrl(), 'setting') ? 'isActive' : '' }}">
                                        <div class="icon-imgbox">
                                            <img src="{{ asset('images/icon_setting.png') }}" alt="">
                                        </div>
                                        <div class="textbox">
                                            設定
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
            @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('pdf-js')
</body>
</html>
