@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/dashboard/index.css') }}">
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
                <li><a href="/company/dashboard" class="isActive"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
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
<div class="main-wrapper">
    <div class="title-container">
        <h3>ダッシュボード</h3>
    </div>

    <div class="alert-container">
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
    </div>

    <div class="incomplete-container">
        <div class="section-container">
            <div class="icon-container">
                <i class="fas fa-receipt"></i>
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
            <div class="icon-container">
                <i class="fas fa-shopping-cart"></i>
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
            <div class="icon-container">
                <i class="fas fa-shopping-bag"></i>
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
        </div>

        <table>
            <thead>
                <tr>
                    <th>プロジェクト</th>
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
                        <img src="/storage/images/default/dummy_user.jpeg" alt="プロフィール画像" width="32px" height="32px">
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
                        <img src="/storage/images/default/dummy_user.jpeg" alt="プロフィール画像" width="32px" height="32px">
                        @if ($project->project->projectPartners->count() > 1) 
                            <p>
                                {{ $project->project->projectPartners[0]->partner->name }} 
                                他{{ $project->project->projectPartners->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->project->projectPartners[0]->partner->name }}</p>
                        @endif
                    </td>
                    <td>{{ $project->project->tasks->count() }}件</td>
                    <td>{{ explode(' ', $project->project->ended_at)[0] }}</td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-btn-container">
            <button>
                もっと見る
                <i class="fas fa-angle-down"></i>
            </button>
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
        </div>

        <table>
            <thead>
                <tr>
                    <th>プロジェクト</th>
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
                    <td>
                        <img src="/storage/images/default/dummy_user.jpeg" alt="プロフィール画像" width="32px" height="32px">
                        @if ($task->task->taskPartners->count() > 1) 
                            <p>
                                {{ $task->task->taskPartners[0]->partner->name }} 
                                他{{ $task->task->taskPartners->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $task->task->taskPartners[0]->partner->name }}</p>
                        @endif
                    </td>
                    <td>
                        @if($task->task->status == 0)
                            <p class="default">下書き</p>
                        @elseif ($task->task->status == 1)
                            <p class="default">提案中</p>
                        @elseif ($task->task->status == 2)
                            <p class="default">依頼前</p>
                        @elseif ($task->task->status == 3)
                            <p class="default">依頼中</p>
                        @elseif ($task->task->status == 4)
                            <p class="default">開始前</p>
                        @elseif ($task->task->status == 5)
                            <p class="default">作業中</p>
                        @elseif ($task->task->status == 6)
                            <p class="default">提出前</p>
                        @elseif ($task->task->status == 7)
                            <p class="default">修正中</p>
                        @elseif ($task->task->status == 8)
                            <p class="complete">完了</p>
                        @else
                            <p class="cancel">キャンセル</p>
                        @endif
                    </td>
                    <td>¥{{ number_format($task->task->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-btn-container">
            <button>
                もっと見る
                <i class="fas fa-angle-down"></i>
            </button>
        </div>
    </div>
</div>
@endsection
