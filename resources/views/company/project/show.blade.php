@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
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
    <!-- アクティビティログメニュー -->
    <!-- <div class="activity-log-menu">
        <div class="activity-log-menu__top">
            <div class="activity-log-menu__top__title">アクティビティログ</div>
            <div id="close-btn" class="close-container"><span class="close-container__btn">閉じる</span><i class="fas fa-long-arrow-alt-right"></i></div>
        </div>
        <div class="notification-wrp">
            <div class="notification-container">
                <div class="notification-container__img-container">
                    <img src="../../../images/photoimg.png" alt="">
                </div>
                <div class="notification-container__content">
                    <p class="notification-container__content__name">永瀬達也</p>
                    <p class="notification-container__content__done">@@@@を作成しました。</p>
                    <p class="notification-container__content__date">2019年1月1日 00:00</p>
                </div>
            </div>
        </div>
        <div class="notification-wrp">
            <div class="notification-container">
                <div class="notification-container__img-container">
                    <img src="../../../images/photoimg.png" alt="">
                </div>
                <div class="notification-container__content">
                    <p class="notification-container__content__name">永瀬達也</p>
                    <p class="notification-container__content__done">@@@@を作成しました。</p>
                    <p class="notification-container__content__date">2019年1月1日 00:00</p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="main__container__wrapper">
        <div>
            <div class="top-container">
                <h1 class="top-container__title">{{ $project->name }}詳細</h1>
                <a class="top-container__edit-btn" href="#"><div>編集</div></a>
            </div>

            <div class="activity-log-container">
                <div class="activity-log-container__left">
                    <div class="activity-log-container__left__name-container">
                        <div class="img-container"><img src="../../../images/photoimg.png" alt=""></div>
                        <p class="name">永瀬達也</p>
                    </div>
                    <div class="activity-log-container__left__content">
                        <p>@@@@を作成しました。</p>
                        <p>2019年1月1日 00:00</p>
                    </div>
                </div>
                <div class="activity-log-container__right">
                    <div id="activity-display-btn" class="activity-log-container__right__btn-container">
                        <i class="fa fa-list-ul"></i><span class="activity-log-container__right__btn-container__btn">アクティビティログ</span>
                    </div>
                </div>
            </div>

            <div class="detail-container">
                <ul class="detail-container__list">
                    <li class="detail-container__list__item margin--none"><div class="detail-container__list__item__name">プロジェクト名</div> <p class="detail-container__list__item__content">{{ $projects->name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト詳細</div><p class="detail-container__list__item__content desc-item">{{ $projects->detail }}</p></li>
                    <li class="detail-container__list__item al-center"><div class="detail-container__list__item__name">担当者</div>
                        <div class="detail-container__list__item__content">
                            @foreach($project->projectCompanies as $projectCompany)
                            <div class="staff-item">
                                <div class="imgbox"><img src="/{{ str_replace('public/', 'storage/', $projectCompany->companyUser->picture) }}" alt=""></div>
                                <p class="name">{{ $projectCompany->companyUser->name }}</p>
                            </div>
                            @endforeach
                        </div> 
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">パートナー</div>
                        <div class="detail-container__list__item__content">
                            @foreach($project->projectPartners as $projectPartner)
                                <div class="staff-item">
                                    <div class="imgbox"><img src="/{{ str_replace('public/', 'storage/', $projectPartner->partner->picture) }}" alt=""></div>
                                    <p class="name">{{ $projectPartner->partner->name }}</p>
                                </div>
                            @endforeach
                            <div class="staff-item">
                                <div class="imgbox"><img src="../../../images/photoimg.png" alt=""></div>
                                <p class="name">永瀬達也</p>
                            </div>
                            <div class="staff-item">
                                <div class="imgbox"><img src="../../../images/photoimg.png" alt=""></div>
                                <p class="name">永瀬達也</p>
                            </div>
                            <!-- @foreach($projects->projectPartners as $projectPartner)
                            {{ $projectPartner->partner->name }}
                            @endforeach -->
                        </div>
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト期間</div>
                        <div class="period__wrapper">
                            <div class="period__wrapper__container">
                                <div class="period__wrapper__container__start">開始日<span class="period__wrapper__container__start__date">{{ $project->started_at->format('Y年m月d日 H:i') }}</span></div>
                                <div class="period__wrapper__container__end">終了日<span class="period__wrapper__container__end__date">{{ $project->ended_at->format('Y年m月d日 H:i') }}</span></div>
                            </div>
                        </div>
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">予算</div><div class="detail-container__list__item__content">{{ number_format($projects->price) }}円</div></li>
                    <li class="detail-container__list__item border-none al-center"><div class="detail-container__list__item__name">資料</div>
                        <div class="detail-container__list__item__content file-item">
                            <div class="imgbox"><img src="../../../images/file.png" alt=""></div>
                            <p>ファイル名</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="task-container">
            <div class="task-container__item">
                <h2 class="task-container__item__title">タスク</h2>
                <ul class="task-container__item__list">
                    <li>プロジェクト</li>
                    <li>タスク</li>
                    <li>パートナー</li>
                    <li>ステータス</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="task-container__content">
                @foreach ($tasks as $task)
                <a class="task-show-link" href="/company/task/{{ $task->id }}">
                    <ul class="task-item-list task-container__content__list">
                        <li class="task-name">{{ $task->project->name }}</li>
                        <li>{{ $task->name }}</li>
                        <li class="partner-item">
                            <div class="imgbox"><img src="../../../images/photoimg.png" alt=""></div>
                            <p class="name">
                            @foreach ($task->taskPartners as $taskPartner)
                                {{ $taskPartner->partner->name }}</p>
                            @endforeach
                        </li>
                        @if($task->status == 0)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">下書き</div>
                        </li>
                        @elseif($task->status == 1)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">提案中</div>
                        </li>
                        @elseif($task->status == 2)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">依頼前</div>
                        </li>
                        @elseif($task->status == 3)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">依頼中</div>
                        </li>
                        @elseif($task->status == 4)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">開始前</div>
                        </li>
                        @elseif($task->status == 5)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">作業中</div>
                        </li>
                        @elseif($task->status == 6)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">提出前</div>
                        </li>
                        @elseif($task->status == 7)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">修正中</div>
                        </li>
                        @elseif($task->status == 8)
                        <li class="task-container__content__list__status">
                            <div class="s-btn done">完了</div>
                        </li>
                        @elseif($task->status == 9)
                        <li class="task-container__content__list__status">
                            <div class="s-btn done">完了</div>
                        </li>
                        @elseif($task->status == 10)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">キャンセル</div>
                        </li>
                        @endif 
                        <li>¥{{ number_format($task->price) }}</li>
                    </ul>
                </a> 
                @endforeach
            </div>

            <div class="task-container__content__showmore">
                <p id="showmore_task_btn" class="task-container__content__showmore__btn">もっと見る</p>
            </div>
        </div>
    </div>    
</div>
@endsection
