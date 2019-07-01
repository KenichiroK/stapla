@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/index.css') }}">
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
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
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
            <h1 class="top-container__title">パートナー</h1>
            <div>
                <p class="control has-icons-left">
                    <input class="search-name input" type="text" placeholder="Search name">
                    <span class="icon is-small is-left">
                    <i class="fas fa-search"></i>
                    </span>
                </p>
            </div>
        </div>

        <div class="paginate-container">
            <!-- <paginate
                class= "paginate"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-class="'prev'"
                :prev-link-class="'prev-link'"
                :next-class="'next'"
                :next-link-class="'next-link'"
                :active-class="'active'"
                :page-count= pageCount
                :click-handler="clickCallback"
                :prev-text="'＜'"
                :next-text="'＞'"
                :container-class="'className'"
            >
            </paginate> -->
        </div>
        
        <div class="profile-list">
        @foreach( $partners as $partner )
        <a href="/company/partner/{{ $partner->id }}">
            <div class="profile-card-container">
           
                <div class="profile-card-container__wrapper">
                    
                    
                    <div class="main-content">
                        <div class="main-content__img-container">
                            <img class="main-content__img-container__img" src="" alt="">
                        </div>
                        <div class="main-content__info-list">
                            <div class="main-content__info-list__name">{{ $partner->name }}</div>
                            <div class="main-content__info-list__job">{{ $partner->occupations }}</div>
                        </div>
                        <div class="main-content__right-icons">
                            <div>
                                <a href="/partner/profile_setting"><i class="main-content__right-icons__pen fas fa-pen"></i></a>
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="icon-list">
                        <div class="icon-list__img_width"></div>
                        <div><a class="default-color github"><i class="fab fa-github icon"></i></a></div>
                        <div><a class="default-color twitter"><i class="fab fa-twitter icon"></i></a></div>
                        <div><a class="default-color facebook"><i class="fab fa-facebook icon"></i></a></div>
                        <div><a class="default-color instagram"><i class="fab fa-instagram icon"></i></a></div>
                        <div><a class="default-color mail"><i class="far fa-envelope icon"></i></a></div>
                    </div>
                </div>
                
            </div>
            </a>
            @endforeach
        </div>

    </div>
</div>
@endsection
