@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/index.css') }}">
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
                    <a href="/company/project" class="isActive">
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
                    <a href="/company/setting/general">
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
            <h1 class="top-container__title">プロジェクト</h1>
            <div>
                <p class="control has-icons-left serch-wrp">
                    <!-- <input class="search-project input" type="text" placeholder="プロジェクトを検索">
                    <span class="">
                    <img src="../../../images/searchicon.png" alt="serch">
                    </span> -->
                </p>
            </div>
            <div class="control project-wrp">
                <a href="project/create"><button class="button">プロジェクト作成</button></a>
            </div>
        </div>

        <ul id="tab-button" class="tab-button">
            <li class="all"><a href="#tab01">プロジェクト</a></li>
            <li class="done"><a href="/company/project/done">完了したプロジェクト</a></li>
        </ul>

        <div class="project-container">
            <div class="project-container__item">
                <ul class="project-container__item__list">
                    <li>プロジェクト
                        <span><i class="arrow fas fa-angle-up"></i><i class="arrow fas fa-angle-down"></i></span>
                    </li>
                    <li>担当者</li>
                    <li>パートナー</li>
                    <li>タスク</li>
                    <li>期限</li>
                    <li>予算</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="project-container__content">
                @foreach( $projects as $project )
                <a class="show-link" href="project/{{ $project->id }}">
                    <ul class="item-list project-container__content__list" >
                        <li class="item-list project-container__content__list__name">{{ $project->name }}</li>
                        <li>
                            <div class="photoimgbox">
                                <img src="/{{ str_replace('public/', 'storage/', $project->projectCompanies[0]->companyUser->picture) }}" alt="担当者プロフィール画像">
                            </div>
                            @if ($project->projectCompanies->count() > 1) 
                                <p>
                                    {{ $project->projectCompanies[0]->companyUser->name }}
                                    他{{ $project->projectCompanies->count() - 1 }}名
                                </p>
                            @else
                                <p>{{ $project->projectCompanies[0]->companyUser->name }}</p>
                            @endif 
                        </li>
                        <li>
                            <div class="photoimgbox">
                                <img src="/{{ str_replace('public/', 'storage/', $project->projectPartners[0]->partner->picture) }}" alt="担当者プロフィール画像">
                            </div>
                            @if ($project->projectPartners->count() > 1) 
                                <p>
                                    {{ $project->projectPartners[0]->partner->name }}
                                    他{{ $project->projectPartners->count() - 1 }}名
                                </p>
                            @else
                                <p>{{ $project->projectPartners[0]->partner->name }}</p>
                            @endif 
                        </li>
                        <li>
                            <span class="txt-underline">{{ $task_count_arr[$loop->index] }}</span>件
                        </li>
                        <li>{{ $project->ended_at->format('Y年m月d日') }}</li>
                        <li>¥{{ number_format($project->budget) }}</li>
                        <li>¥{{ number_format($project->price) }}</li>
                    </ul>
                </a>
                @endforeach
            </div>

            <div class="project-container__content__showmore">
                <p id="showmore_btn" class="project-container__content__showmore__btn"><a>もっと見る</a>
                    <span><img src="../../../images/arrowdown.png"></span>
                </p>
            </div>
        </div> 
    </div>
</div>
@endsection
