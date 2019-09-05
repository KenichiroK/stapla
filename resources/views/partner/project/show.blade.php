@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $partner->name }}
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
                    <form method="POST" action="{{ route('partner.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <a href="/partner/profile">
            <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
        </a>
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
                    <a href="/partner/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
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
                    <a href="/partner/setting/invoice">
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
        <div>
            <div class="top-container">
                <h1 class="top-container__title">{{ $project->name }}詳細</h1>
                <!-- <a class="top-container__edit-btn" href="#"><div>編集</div></a> -->
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
                    <li class="detail-container__list__item margin--none"><div class="detail-container__list__item__name">プロジェクト名</div> <p class="detail-container__list__item__content">{{ $project->name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト詳細</div><p class="detail-container__list__item__content desc-item">{{ $project->detail }}</p></li>
                    <li class="detail-container__list__item al-center"><div class="detail-container__list__item__name">担当者</div>
                        <div class="detail-container__list__item__content">
                        {{ $project->task }}
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
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">予算</div><div class="detail-container__list__item__content">{{ number_format($project->price) }}円</div></li>
                    <!-- <li class="detail-container__list__item border-none al-center"><div class="detail-container__list__item__name">資料</div>
                        <div class="detail-container__list__item__content file-item">
                            <div class="imgbox"><img src="../../../images/file.png" alt=""></div>
                            <p>ファイル名</p>
                        </div>
                    </li> -->
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
                                <div class="imgbox"><img src="/{{ str_replace('public/', 'storage/', $task->partner->picture) }}" alt=""></div>
                                <p class="name">{{ $task->partner->name }}</p>
                            </li>
                            @if($task->status === 0)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">下書き</div>
                                </li>
                            @elseif($task->status === 1)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスク上長確認前</div>
                                </li>
                            @elseif($task->status === 2)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスク上長確認中</div>
                                </li>
                            @elseif($task->status === 3)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスクパートナー依頼前</div>
                                </li>
                            @elseif($task->status === 4)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスクパートナー依頼中</div>
                                </li>
                            @elseif($task->status === 5)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書作成中</div>
                                </li>
                            @elseif($task->status === 6)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書作成完了</div>
                                </li>
                            @elseif($task->status === 7)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書上長確認中</div>
                                </li>
                            @elseif($task->status === 8)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書パートナー依頼前</div>
                                </li>
                            @elseif($task->status === 9)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書パートナー確認中</div>
                                </li>
                            @elseif($task->status === 10)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">作業中</div>
                                </li>
                            @elseif($task->status === 11)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書依頼中</div>
                                </li>
                            @elseif($task->status === 12)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書確認中</div>
                                </li>
                            @elseif($task->status === 13)
                                <li class="task-container__content__list__status">
                                    <div class="s-btn done">完了</div>
                                </li>
                            @elseif($task->status === 14)
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
