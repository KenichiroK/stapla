@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
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
    <div class="activity-log-menu">
        <div class="activity-log-menu__top">
            <div class="activity-log-menu__top__title">アクティビティログ</div>
            <div id="close-btn" class="close-container"><span class="close-container__btn">閉じる</span><i class="fas fa-long-arrow-alt-right"></i></div>
        </div>
        <div class="notification-container">
            <div class="notification-container__img-container">
                <img src="http://jacksonunityfestival.org/img/323880.png" alt="">
            </div>
            <div class="notification-container__content">
                <p class="notification-container__content__name">name</p>
                <p class="notification-container__content__done">@@@@を作成しました。</p>
                <p class="notification-container__content__date">2019年1月1日 00:00</p>
            </div>
        </div>
    </div>

    <div class="main__container__wrapper">
        <div>
            <div class="top-container">
                <h1 class="top-container__title">{{ $projects->name }}詳細</h1>
                <a class="top-container__edit-btn" href="#"><div>編集</div></a>
            </div>

            <div class="activity-log-container">
                <div class="activity-log-container__left">
                    <div class="activity-log-container__left__name-container">
                        <div class="img-container"><img src="http://jacksonunityfestival.org/img/323880.png" alt=""></div>
                        <p class="name">name</p>
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
                    <li class="detail-container__list__item margin--none"><div class="detail-container__list__item__name">プロジェクト名 :</div> <p class="detail-container__list__item__content">{{ $projects->name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト詳細 :</div><p class="detail-container__list__item__content">{{ $projects->detail }}</p></li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">担当者 :</div><p class="detail-container__list__item__content">{{ $projects->company->representive_name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">パートナー :</div>
                        <p class="detail-container__list__item__content">
                            @foreach($projects->projectPartners as $projectPartner)
                            {{ $projectPartner->partner->name }}
                            @endforeach
                        </p>
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト期間 :</div>
                        <div class="period__wrapper">
                            <div class="period__wrapper__container">
                                <div class="period__wrapper__container__start">開始日<span class="period__wrapper__container__start__date">{{ $projects->started_at->format('Y年m月d日 H:i') }}</span></div>
                                <div class="period__wrapper__container__end">終了日<span class="period__wrapper__container__end__date">{{ $projects->ended_at->format('Y年m月d日 H:i') }}</span></div>
                            </div>
                        </div>
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">予算</div><div class="detail-container__list__item__content"></div>¥{{ number_format($projects->price) }}</li>
                    <li class="detail-container__list__item border-none"><div class="detail-container__list__item__name">資料</div><div class="detail-container__list__item__content"></div></li>
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
                        <li>
                        <p>
                        @foreach ($task->taskPartners as $taskPartner)
                            {{ $taskPartner->partner->name }}</p>
                        @endforeach
                        </li>
                        @if($task->status == 0)
                        <li class="task-container__content__list__status">
                            下書き
                        </li>
                        @elseif($task->status == 1)
                        <li class="task-container__content__list__status">
                            提案中
                        </li>
                        @elseif($task->status == 2)
                        <li class="task-container__content__list__status">
                            依頼前
                        </li>
                        @elseif($task->status == 3)
                        <li class="task-container__content__list__status">
                            依頼中
                        </li>
                        @elseif($task->status == 4)
                        <li class="task-container__content__list__status">
                            開始前
                        </li>
                        @elseif($task->status == 5)
                        <li class="task-container__content__list__status">
                            作業中
                        </li>
                        @elseif($task->status == 6)
                        <li class="task-container__content__list__status">
                            提出前
                        </li>
                        @elseif($task->status == 7)
                        <li class="task-container__content__list__status">
                            修正中
                        </li>
                        @elseif($task->status == 8)
                        <li class="task-container__content__list__status">
                            完了
                        </li>
                        @elseif($task->status == 9)
                        <li class="task-container__content__list__status">
                            完了
                        </li>
                        @elseif($task->status == 10)
                        <li class="task-container__content__list__status">
                            キャンセル
                        </li>
                        @endif 
                        <li>¥{{ number_format($task->price) }}</li>
                    </ul>
                </a> 
                @endforeach
            </div>

            <div class="task-container__content__showmore">
                <p id="showmore_task_btn" class="task-container__content__showmore__btn">もっと見る<i class="arrow fas fa-angle-down"></i></p>
            </div>
        </div>
    </div>    
</div>
@endsection
