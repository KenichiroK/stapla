@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/dashboard/index.css') }}">
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
                        <!-- <i class="fas fa-home"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard" class="isActive">
                        <!-- <i class="fas fa-chart-bar"></i> -->
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
                        <!-- <i class="fas fa-envelope"></i> -->
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
                        <!-- <i class="fas fa-tasks"></i> -->
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
                        <!-- <i class="fas fa-newspaper"></i> -->
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
                        <!-- <i class="fas fa-user-circle"></i> -->
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
                        <!-- <i class="fas fa-calendar-alt"></i> -->
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
                        <!-- <i class="fas fa-question"></i> -->
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
                        <!-- <i class="fas fa-cog"></i> -->
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
<div class="main-wrapper">
    <div class="title-container">
        <h3>ダッシュボード</h3>
    </div>

    <!-- <div class="alert-container">
        <div class="icon-container">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="project-alert-container">
            <p>プロジェクトアラート</p>
            <h4 class="alert-text">3</h4>
        </div>

        <div class="task-alert-container">
            <p>タスクアラート</p>
            <h4>0</h4>
        </div>
    </div> -->

    <div class="incomplete-container">
        <div class="section-container">
            <div class="icon-imgbox">
                <img src="../../../images/invoice.png" alt="">
            </div>
            <div class="text-container">
                <h4>未請求書</h4>
                <p>{{ $invoices->count() }}</p>
            </div>
            <div class="btn-container">
                <button>確認</button>
            </div>
        </div>

        <div class="section-container">
            <div class="icon-imgbox">
                <img src="../../../images/order.png" alt="">
            </div>
            <div class="text-container">
                <h4>発注書未対応</h4>
                <p>{{ $purchaseOrders->count() }}</p>
            </div>
            <div class="btn-container">
                <button>作成</button>
            </div>
        </div>

        <div class="section-container">
            <div class="icon-imgbox">
                <img src="../../../images/non-disclosur.png" alt="">
            </div>
            <div class="text-container">
                <h4>機密保持契約書未対応</h4>
                <p>{{ $ndas->count() }}</p>
            </div>
            <div class="btn-container">
                <button>作成</button>
            </div>
        </div>
    </div>

    <div class="project-container">
        <div class="title-container">
            <h4>プロジェクト</h4>
            <div class="btn-container">
                <button >プロジェクト作成</button>
            </div>
        </div>

        <table class="project-container__table">
            <thead>
                <tr>
                    <th>プロジェクト
                        <span>
                            <i class="arrow fas fa-angle-up"></i>
                            <i class="arrow fas fa-angle-down"></i>
                        </span>
                    </th>
                    <th>担当者</th>
                    <th>パートナー</th>
                    <th>タスク</th>
                    <th>期限</th>
                    <th>予算</th>
                    <th>請求額</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td class="project_name">{{ $project->project->name }}</td>
                    <td>
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $project->project->projectCompanies[0]->companyUser->picture) }}" alt="">
                        </div>                       
                        @if ($project->project->projectCompanies->count() > 1)
                            <p>
                                {{ $project->project->projectCompanies[0]->companyUser->name }} 
                                他{{ $project->project->projectCompanies->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->project->projectCompanies[0]->companyUser->name }}</p>
                        @endif
                    </td>
                    <td>
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $project->project->projectPartners[0]->partner->picture) }}" alt="">
                        </div>
                        <!-- <img src="/storage/images/default/dummy_user.jpeg" alt="プロフィール画像" width="32px" height="32px"> -->
                        @if ($project->project->projectPartners->count() > 1) 
                            <p>
                                {{ $project->project->projectPartners[0]->partner->name }} 
                                他{{ $project->project->projectPartners->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->project->projectPartners[0]->partner->name }}</p>
                        @endif
                    </td>
                    <td><span class="underline">{{ $project->project->tasks->count() }}</span>件</td>
                    <td>{{ explode(' ', $project->project->ended_at)[0] }}</td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <!-- <div class="more-btn-container">
            <button id="projectShowMoreBtn">
                もっと見る
                <i class="fas fa-angle-down"></i>
            </button>
        </div> -->
        <div class="more-container__wrapper">
            <p id="projectShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
        </div>
    </div>

    <div class="taskStatus-container">
        <div class="title-container">
            <h4>ステータス</h4>
        </div>

        <div class="section-container">
            @for ($i = 0; $i < count($statusName_arr); $i++)
            <div class="status-card">
                <p class="key">{{ $statusName_arr[$i] }}</p>
                <p class="value">{{ $status_arr[$i] }}</p>
            </div>
            @endfor
        </div>
    </div>

    <div class="task-container">
        <div class="title-container">
            <h4>タスク</h4>
            <div class="btn-container">
                <button >タスク作成</button>
            </div>
        </div>

        <table class="task-container__table">
            <thead>
                <tr>
                    <th>プロジェクト
                        <span>
                            <i class="arrow fas fa-angle-up"></i>
                            <i class="arrow fas fa-angle-down"></i>
                        </span>
                    </th>
                    <th>タスク</th>
                    <th>パートナー</th>
                    <th>ステータス</th>
                    <th>請求額</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td class="project_name">{{ $task->task->project->name }}</td>
                    <td>{{ $task->task->name }}</td>
                    <td class="partner">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $task->task->partner->picture) }}" alt="">
                        </div>
                        <p>{{ $task->task->partner->name }}</p>
                    </td>
                    <td>
                        @if(($task->task->status) === 0)
                            下書き
                        @elseif(($task->task->status) === 1)
                            タスク上長確認前
                        @elseif(($task->task->status) === 2)
                            タスク上長確認中
                        @elseif(($task->task->status) === 3)
                            タスクパートナー依頼前
                        @elseif(($task->task->status) === 4)
                            タスクパートナー依頼中
                        @elseif(($task->task->status) === 5)
                            発注書作成中
                        @elseif(($task->task->status) === 6)
                            発注書作成完了
                        @elseif(($task->task->status) === 7)
                            発注書上長確認中
                        @elseif(($task->task->status) === 8)
                            発注書パートナー依頼前
                        @elseif(($task->task->status) === 9)
                            発注書パートナー確認中
                        @elseif(($task->task->status) === 10)
                            作業中
                        @elseif(($task->task->status) === 11)
                            請求書依頼中
                        @elseif(($task->task->status) === 12)
                            請求書確認中
                        @elseif(($task->task->status) === 13)
                            完了
                        @elseif(($task->task->status) === 14)
                            キャンセル
                        @endif
                    </td>
                    <td>¥{{ number_format($task->task->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <!-- <div class="more-btn-container">
            <button id="taskShowMoreBtn">
                もっと見る
                <i class="fas fa-angle-down"></i>
            </button>
        </div> -->
        <div class="more-container__wrapper">
            <p id="taskShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
        </div>


    </div>
</div>
@endsection
