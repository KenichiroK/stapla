<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-id" content="{{ Auth::user()->id }}">
    <meta name="url" content="{{ env('APP_URL') }}">

    <title>Impro</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ env('AWS_URL') }}/common/impro_favicon.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style id='stylesheet' type='text/css'></style> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    @yield('assets')
</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div id="navbarHomeHeader" class="navbar-menu">
                    <div class="navbar-end">
                        <ul class="icon-wrp">
                            <li class="not">
                                @if (countReadAtIsNULL() === 0)
                                    <button type="button" class="notification-icon-badge">
                                @else
                                    <button
                                        class="notification-icon-badge"
                                        type="button"
                                        data-badge="{{ countReadAtIsNULL() > 99 ? '99+' : countReadAtIsNULL() }}"
                                    >
                                @endif
                                    <img id="notification_icon" src="{{ env('AWS_URL') }}/common/icon_notification2.png" alt="search">
                                </button>
                            </li>
                        </ul>
                        <div class="header-proflie">
                            <div class="user-imgbox">
                                <a href="{{ route('partner.setting.profile.create') }}">
                                    <img src="{{ Auth::user()->picture }}" alt="プロフィール画像">
                                </a>
                            </div>
                            <div class="option">
                                <div class="user-name">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="icon-imgbox">
                                    <img src="{{ env('AWS_URL') }}/common/icon_small-down.png" alt="">
                                </div>
                            </div>
                            
                            <div class="optionBox">
                                <div class="balloon">
                                    <ul>
                                        <li><a href="{{ route('partner.setting.profile.create') }}">プロフィール設定</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('partner.logout') }}">
                                                @csrf
                                                <button type="submit">ログアウト</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>      

        <main>
            <div id="notification_bar" class="notification-wrapper">
                @include('components.notification_bar')
            </div>

            <div class="sidebar-wrapper">
               @include('partner.common.sidebar')
            </div>

            <div class="content-wrapper">
            @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/common/toggle-notification-bar.js') }}" defer></script>
    <script src="{{ asset('js/common/update-notification-mark-as-read.js') }}" defer></script>
    <script>
        const project_create = {{ config('const.PROJECT_CREATE') }};
        const project_complete = {{ config('const.PROJECT_COMPLETE') }};
        const project_canceled = {{ config('const.PROJECT_CANCELED') }};

        const task_create = {{ config('const.TASK_CREATE') }};
        const task_submit_superior = {{ config('const.TASK_SUBMIT_SUPERIOR') }};
        const task_approval_superior = {{ config('const.TASK_APPROVAL_SUPERIOR') }};
        const task_submit_partner = {{ config('const.TASK_SUBMIT_PARTNER') }};
        const task_approval_partner = {{ config('const.TASK_APPROVAL_PARTNER') }};
        const order_submit_superior = {{ config('const.ORDER_SUBMIT_SUPERIOR') }};
        const order_approval_superior = {{ config('const.ORDER_APPROVAL_SUPERIOR') }};
        const order_submit_partner = {{ config('const.ORDER_SUBMIT_PARTNER') }};
        const order_approval_partner = {{ config('const.ORDER_APPROVAL_PARTNER') }};
        const working = {{ config('const.WORKING') }};
        const delivery_partner = {{ config('const.DELIVERY_PARTNER') }};
        const acceptance = {{ config('const.ACCEPTANCE') }};
        const invoice_draft_create = {{ config('const.INVOICE_DRAFT_CREATE') }};
        const invoice_create = {{ config('const.INVOICE_CREATE') }};
        const submit_staff = {{ config('const.SUBMIT_STAFF') }};
        const submit_accounting = {{ config('const.SUBMIT_ACCOUNTING') }};
        const approval_accounting = {{ config('const.APPROVAL_ACCOUNTING') }};
        const complete_staff = {{ config('const.COMPLETE_STAFF') }};
        const task_canceled = {{ config('const.TASK_CANCELED') }};
    </script>
    <script>
       function toggleNotificationBar() {
            $('#notification_bar').toggleClass('isActive');
        }
    </script>
    @yield('asset-js')
</body>
</html>
