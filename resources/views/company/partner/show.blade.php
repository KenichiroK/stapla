@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/show.css') }}">
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
            <div class="left-area">
                <div class="basic-info">
                    <div class="basic-info__img-container">
                        <img class="basic-info__img-container__img" src="http://j.people.com.cn/NMediaFile/2016/0525/FOREIGN201605250833000238664034809.jpg" alt="">
                    </div>
                    <div class="basic-info__name">{{ $partners->name }}</div>
                    <div class="basic-info__evaluation">
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <div class="basic-info__job">{{ $partners->occupations }}</div>
                    <div class="basic-info__icons">
                        <div class="basic-info__icons__git"><i class="icon fab fa-github"></i></div>
                        <div class="basic-info__icons__twitter"><i class="icon fab fa-twitter"></i></div>
                        <div class="basic-info__icons__fb"><i class="icon fab fa-facebook"></i></div>
                        <div class="basic-info__icons__insta"><i class="icon fab fa-instagram"></i></div>
                    </div>
                </div>
                <div class="border"></div>
                <div class="skill">
                    <div class="skill__sub-title">SKILL</div>
                    <ul class="skill__list">
                        @if(isset($partners->skill) >1)
                            @foreach($partners as $partner)
                                <li>{{ $partner->skill }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="works">
                    <div class="works__sub-title">WORK</div>
                    <ul class="works__list">
                        @if(isset($partners->careersummary) >1)
                            @foreach($partners as $partner)
                                <li>{{ $partner->careersummary }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="about-me">
                    <div class="about-me__sub-title">ABOUT ME</div>
                    <div class="about-me__content">{{ $partners->introduction }}</div>
                </div>
                <div class="contact">
                    <div class="contact__sub-title">CONTACT</div>
                </div>
            </div>
            <div class="center-area">
            @if($tasks->count() !== 0)
            @foreach($tasks as $task)
                <div class="project-container">
                
                    <div class="project-container__separate">
                        <div class="project-container__separate__circle"></div>
                        <div class="project-container__separate__line-container">
                            <div class="line"></div>
                        </div>
                    </div>
                    
                    <div class="project-container__wrapper">
                        <div class="date-container">
                            <div class="date-container__date">2019.0131</div>
                        </div>
                        <div class="project">
                            <div class="project__item">プロジェクト名</div>
                            <div class="project__name">{{ $task->task->project->name }}</div>
                        </div>
                        
                        <div class="task">
                            <div class="task__item">タスク名</div>
                            <div class="task__name">{{ $task->task->name }}</div>
                        </div>
                        <!-- <div class="role">
                            <div class="role__item">役割名</div>
                            <div class="role__name">DBの初期からの構築。</div>
                        </div> -->
                        <div class="evaluation">
                            <div class="evaluation__item">
                                <span>評価: </span>
                                <span>
                                    {{ $task->task->rating }}
                                </span>
                                <!-- <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i> -->
                            </div>
                            <div class="evaluation__content">test coment</div>
                        </div>
                    </div>
                    
                </div>
                @endforeach
                @else
                    <div>
                        <p>業務履歴はありません</p>
                    </div>
                @endif
            </div>
            <div class="right-area">
                <div class="portfolio">
                    <div class="portfolio__img-container">
                        <img class="portfolio__img-container__img" src="http://j.people.com.cn/NMediaFile/2016/0525/FOREIGN201605250833000238664034809.jpg" alt="">
                    </div>
                    <div class="portfolio__title">留学生研究所HP</div>
                    <div class="portfolio__description">description</div>
                </div>
            </div>
        </div>
    </div>
@endsection
