@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/index.css') }}">
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li class="isActive"><a href="/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
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
                <p class="control has-icons-left">
                    <input class="search-project input" type="text" placeholder="Search project">
                    <span class="icon is-small is-left">
                    <i class="fas fa-search"></i>
                    </span>
                </p>
            </div>
            <div class="control">
                <button class="button btn"><a href="project/create">プロジェクト作成</a></button>
            </div>
        </div>

        <div class="project-container">
            <h2 class="project-container__item__title">プロジェクト</h2>
            <div class="project-container__item">
                <ul class="project-container__item__list">
                    <li>プロジェクト</li>
                    <li>担当者<i class="arrow fas fa-angle-down"></i></li>
                    <li>パートナー<i class="arrow fas fa-angle-down"></i></li>
                    <li>タスク</li>
                    <li>期限<i class="arrow fas fa-angle-down"></i></li>
                    <li>予算</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="project-container__content">
                @foreach( $projects as $project )
                <ul class="item-list project-container__content__list" >
                    <li>{{ $project->name }}</li>
                    <li>
                        <p>{{ $project->company->representive_name }}</p>
                    </li>
                    <li>
                        @foreach( $project->projectPartners as $projectPartner )
                        <p>{{ $projectPartner->partner->name }}</p>
                        @endforeach
                    </li>
                    <li>
                        {{ $task_count_arr[$loop->index] }}件
                    </li>
                    <li>{{ $project->ended_at }}</li>
                    <li>¥{{ $project->budget }}</li>
                    <li>¥{{ $project->price }}</li>
                </ul>
                @endforeach
            </div>

            <div class="project-container__content__showmore">
                <p id="showmore_btn" class="project-container__content__showmore__btn">もっと見る</p>
            </div>
        </div> 
    </div>
</div>
@endsection
