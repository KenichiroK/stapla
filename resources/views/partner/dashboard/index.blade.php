@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/dashboard/index.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $partner->name }}
</div>
<div class="navbar-item">
    <img src="../images/dummy_user.jpeg" alt="プロフィール画像">
</div>
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
                <li><a href="/partner/dashboard"  class="isActive"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/partner/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/partner/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                <form method="POST" action="{{ route('partner.logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
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
        <div class="title-container">
            <h1 class="title-container__title">パートナーダッシュボード</h1>
        </div>

        <div class="alert-container">
            <div class="top-container">
                <div class="top-container__project">
                    <div class="top-container__project__left"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="top-container__project__center">
                        <div class="count">0</div>
                        <div class="alert-name">プロジェクトアラート</div>
                    </div>
                    <div class="top-container__project__right">btn</div>
                </div>
                <div class="top-container__task">
                    <div class="top-container__task__left">icon</div>
                    <div class="top-container__task__center">
                        <div class="count">0</div>
                        <div class="alert-name">タスクアラート</div>
                    </div>
                    <div class="top-container__task__right"></div>
                </div>
            </div>
            <div class="bottom-container">
                <div class="bottom-container__invoice">
                    <div class="bottom-container__invoice__left">icon</div>
                    <div class="bottom-container__invoice__center">
                        <div class="count">0</div>
                        <div class="alert-name">請求書未対応</div>
                    </div>
                    <div class="bottom-container__invoice__right">
                        <button class="btn">作成</button>
                    </div>
                </div>
                <div class="bottom-container__order">
                    <div class="bottom-container__order__left"><i class="fas fa-shopping-cart"></i></div>
                    <div class="bottom-container__order__center">
                        <div class="count">0</div>
                        <div class="alert-name">発注書未対応</div>
                    </div>
                    <div class="bottom-container__order__right">
                        <button class="btn">承認</button>
                    </div>
                </div>
                <div class="bottom-container__nda">
                    <div class="bottom-container__nda__left"><i class="fas fa-shopping-bag"></i></div>
                    <div class="bottom-container__nda__center">
                        <div class="count">0</div>
                        <div class="alert-name">機密保持契約書未対応</div>
                    </div>
                    <div class="bottom-container__nda__right">
                        <button class="btn">承認</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-container">
            <h2 class="project-container__item__title">Project</h2>
            <div class="project-container__item">
                <ul class="project-container__item__list">
                    <li>プロジェクト<i class="arrow fas fa-angle-down"></i></li>
                    <li>担当者<i class="arrow fas fa-angle-down"></i></li>
                    <li>パートナー<i class="arrow fas fa-angle-down"></i></li>
                    <li>タスク</li>
                    <li>期限<i class="arrow fas fa-angle-down"></i></li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="project-container__content">
                @foreach($projects as $project)
                <ul class="project-container__content__list" >
                    <li>{{ $project->project->name }}</li>
                    <li>
                        @foreach($project->project->projectCompanies as $project_company)
                            <p>{{ $project_company->companyUser->name }}</p>
                        @endforeach
                    </li>
                    <li>yamada</li>
                    <li>{{ $project->project->tasks->count() }}件</li>
                    <li>{{ explode(' ', $project->project->ended_at)[0] }}</li>
                    <li>¥{{ $project->project->budget }}</li>
                </ul>
                @endforeach
            </div>

            <div class="project-container__content__showmore">
                <p @click="showMoreProject(4)" class="project-container__content__showmore__btn">Show More</p>
            </div>
        </div>
                            
        <div class="task-container">
            <h2 class="task-container__item__title">task</h2>
            <div class="task-container__item">
                <ul class="task-container__item__list">
                    <li>プロジェクト<i class="arrow fas fa-angle-down"></i></li>
                    <li>タスク<i class="arrow fas fa-angle-down"></i></li>
                    <li>パートナー<i class="arrow fas fa-angle-down"></i></li>
                    <li>ステータス<i class="arrow fas fa-angle-down"></i></li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="task-container__content">
                @foreach($tasks as $task)
                <ul class="task-container__content__list" >
                    <li>{{ $task->task->project->name }}</li>
                    <li>{{ $task->task->name }}</li>
                    <li>
                        @foreach($task->task->taskPartners as $task_partner)
                            <p>{{ $task_partner->partner->name }}</p>
                        @endforeach
                    </li>
                    @if($task->task->status == 0)
                    <li><div class="state">下書き</div></li>
                    @elseif ($task->task->status == 1)
                    <li><div class="state">提案中</div></li>
                    @elseif ($task->task->status == 2)
                    <li><div class="state">依頼前</div></li>
                    @elseif ($task->task->status == 3)
                    <li><div class="state">依頼中</div></li>
                    @elseif ($task->task->status == 4)
                    <li><div class="state">開始前</div></li>
                    @elseif ($task->task->status == 5)
                    <li><div class="state">作業中</div></li>
                    @elseif ($task->task->status == 6)
                    <li><div class="state">提出前</div></li>
                    @elseif ($task->task->status == 7)
                    <li><div class="state">修正中</div></li>
                    @elseif ($task->task->status == 8)
                    <li><div class="state">完了</div></li>
                    @else
                    <li><div class="state">キャンセル</div></li>
                    @endif
                    <li>¥{{ $task->task->price }}</li>
                </ul>
                @endforeach
            </div>

            <div class="task-container__content__showmore">
                <p @click="showMoreTask(4)" class="task-container__content__showmore__btn">Show More</p>
            </div>
        </div>
                            
    </div>
</div>
@endsection
