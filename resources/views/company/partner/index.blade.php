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
            <img src="../../../images/icon_small-down.png" alt="">
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
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-home"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <!-- <i class="fas fa-chart-bar"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <!-- <i class="fas fa-envelope"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <!-- <i class="fas fa-tasks"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
                        <!-- <i class="fas fa-newspaper"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner" class="isActive">
                        <!-- <i class="fas fa-user-circle"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-calendar-alt"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-question"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <!-- <i class="fas fa-cog"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
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
        <div class="top-container">
            <h1 class="top-container__title">パートナー</h1>
            <div>
                <p class="control has-icons-left serch-wrp">
                    <input class="search-name input" type="text" placeholder="パートナーを検索">
                    <span class="icon">
                    <!-- <i class="fas fa-search"></i> -->
                    <img src="../../../images/searchicon.png" alt="serch">
                    </span>
                </p>
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
                                    <a href="/partner/profile_setting"><img src="../../../images/edit.png" alt=""></a>
                                </div>
                            </div>
                            <div class="main-content__close-icons">
                                <div>
                                    <a href=""><div class="close-parts"><span></span></div></a>
                                </div>
                            </div>
                        </div>
                        <div class="icon-list-wrp">
                            <div class="icon-list">
                                <!-- <div><a class="default-color github"><i class="fab fa-github icon"></i></a></div>
                                <div><a class="default-color twitter"><i class="fab fa-twitter icon"></i></a></div>
                                <div><a class="default-color facebook"><i class="fab fa-facebook icon"></i></a></div>
                                <div><a class="default-color instagram"><i class="fab fa-instagram icon"></i></a></div>
                                <div><a class="default-color mail"><i class="far fa-envelope icon"></i></a></div> -->
                                <div><a class="default-color github"><img src="../../../images/github.png" alt=""></a></div>
                                <div><a class="default-color twitter"><img src="../../../images/twitter.png" alt=""></a></div>
                                <div><a class="default-color facebook"><img src="../../../images/facebook.png" alt=""></a></div>
                                <div><a class="default-color instagram"><img src="../../../images/insta.png" alt=""></a></div>
                                <div><a class="default-color mail"><img src="../../../images/mail.png" alt=""></a></div>
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
            <div class="btn-container">
                <a href="/company/invite/partner">担当者を招待する</a>
            </div>
        </div>
    </div>
</div>
@endsection
