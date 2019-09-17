@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/index.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
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
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection

@section('sidebar')
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
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_dashboard.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_invoices.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner" class="isActive">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_customers-active.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
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
                    <a href="/company/setting/general">
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
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        @if (session('send_success'))
        <div class="complete-container">
            <p>{{ session('send_success') }}</p>
        </div>
        @endif

        <div class="top-container">
            <h1 class="top-container__title">パートナー</h1>
                <!-- <p class="control has-icons-left serch-wrp">
                    <input class="search-name input" type="text" placeholder="パートナーを検索">
                    <span class="icon">
                    <img src="{{ asset('images/searchicon.png') }}" alt="serch">
                    </span>
                </p> -->
                <div class="btn-container">
                    <a href="/company/invite/partner">パートナー追加</a>
                </div>
        </div>
        
        <div class="profile-list">
            
            @foreach( $partners as $partner )
            
            <div class="profile-card-container">
                <!-- <a href="/company/partner/{{ $partner->id }}"> -->
                    <div class="profile-card-container__wrapper">
                        <div class="main-content">
                            <div class="main-content__img-container">
                                <!-- <img class="main-content__img-container__img" src="" alt=""> -->
                                <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}"  alt="">
                            </div>
                            <div class="main-content__info-list">
                                <div class="main-content__info-list__name">{{ $partner->name }}</div>
                                <div class="main-content__info-list__job">{{ $partner->occupations }}</div>
                                <div class="main-content__info-list__assessment-achievement">
                                    <div class="assessment">⭐⭐⭐⭐</div>
                                    <div class="achievement">実績<span class="num">1</span><span class="ken">件</span></div>
                                
                                </div>
                                
                            </div>
                            <div class="main-content__edit-icons">
                                <div>
                                    <a href="/partner/profile_setting"><img src="{{ asset('images/edit.png') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="icon-list-wrp">
                            <div class="icon-list">
                                <div><a class="default-color github"><img src="{{ asset('images/github.png') }}" alt=""></a></div>
                                <div><a class="default-color twitter"><img src="{{ asset('images/twitter.png') }}" alt=""></a></div>
                                <div><a class="default-color facebook"><img src="{{ asset('images/facebook.png') }}" alt=""></a></div>
                                <div><a class="default-color instagram"><img src="{{ asset('images/insta.png') }}" alt=""></a></div>
                                <div><a class="default-color mail"><img src="{{ asset('images/mail.png') }}" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                <!-- </a> -->
            </div>
            
            @endforeach
            
            <div class="pagenate-container">
                <div class="pagenate-container__wrapper">
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
