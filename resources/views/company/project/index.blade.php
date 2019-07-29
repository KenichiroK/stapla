@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/index.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $company_user->name }}
</div>
<div class="navbar-item">
    <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
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
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li class="isActive"><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
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
                    <input class="search-project input" type="text" placeholder="プロジェクトを検索">
                    <span class="">
                    <!-- <i class="fas fa-search"></i> -->
                    <img src="../../../images/searchicon.png" alt="serch">
                    </span>
                </p>
            </div>
            <div class="control project-wrp">
                <a href="project/create"><button class="button">プロジェクト作成</button></a>
            </div>
        </div>

        <ul id="tab-button" class="tab-button">
            <li class="all"><a href="#tab01">プロジェクト</a></li>
            <li class="done"><a href="#tab02">完了したプロジェクト</a></li>
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
                        <li>{{ $project->ended_at->format('Y年m月d日 H時') }}</li>
                        <li>¥{{ number_format($project->budget) }}</li>
                        <li>¥{{ number_format($project->price) }}</li>
                    </ul>
                </a>
                @endforeach
            </div>

            <div class="project-container__content__showmore">
                <p id="showmore_btn" class="project-container__content__showmore__btn"><a>もっと見る</a>
                    <!-- <i class="arrow fas fa-angle-down"></i> -->
                    <span><img src="../../../images/arrowdown.png"></span>
                </p>
            </div>
        </div> 
    </div>
</div>
@endsection
