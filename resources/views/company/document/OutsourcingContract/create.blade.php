@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="">
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general" class="isActive">
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
        <!--main__container__wrapperに記述していく-->
        <div class="page-title-container">
            <div class="page-title-container__page-title">業務委託契約書作成画面</div>
        </div>
        <div class="main-container">
            <form action="" method="post">
            
                <div class="main-container__wrapper">
                    <!-- タスク -->
                    <dl>
                        <dt>
                            タスク
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-arrow">
                                <select class="select-container__wrapper__select" name="task_id">
                                    <option disabled selected></option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 作成日 -->
                    <dl>
                        <dt>
                            作成日
                        </dt>
                        <dd>
                        <div class="date-container">
                            <div class="date-container__wrapper">
                                <div class="text">作成日</div>
                                <div class="icon-imgbox">
                                    <img src="../../../images/icon_calendar.png" alt="">
                                </div>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 担当者 -->
                    <dl>
                        <dt>
                            担当者
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-plusicon">
                                <select class="select-container__wrapper__select" name='companyUser_id'>
                                    <option disabled selected></option>
                                    <option value=""></option>                           
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- パートナー -->
                    <dl>
                        <dt>
                            パートナー
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-plusicon">
                                <select class="select-container__wrapper__select" name='partner_id'>
                                    <option disabled selected></option>
                                    <option value=""></option>                            
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 委託内容 -->
                    <dl class="last">
                        <dt>
                            委託内容
                        </dt>
                        <dd>
                        <div class="input-container">
                            <div class="input-container__wrapper">
                                <input name="" type="text" class="input form-control">
                            </div>
                        </div>
                        </dd>
                    </dl>
                </div>
                <!-- 作成ボタン -->
                <div class="button-container">
                    <button type="submit">作成</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
