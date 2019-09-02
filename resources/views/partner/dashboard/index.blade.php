@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/dashboard/index.css') }}">
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
                    <a href="/partner/dashboard" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
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
<div class="main-wrapper">
    <div class="title-container">
        <h3>ダッシュボード</h3>
    </div>

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
                <!-- <button>確認</button> -->
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
                <!-- <button>作成</button> -->
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
                <!-- <button>作成</button> -->
            </div>
        </div>
    </div>

    <div class="project-container">
        <div class="title-container">
            <h4>プロジェクト</h4>
        </div>

        <table id="partner-project-table">
            <thead>
                <tr>
                    <th>プロジェクト
                        <!-- <span>
                            <i class="arrow fas fa-angle-up"></i>
                            <i class="arrow fas fa-angle-down"></i>
                        </span> -->
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
                    <td class="staff">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $project->project->projectCompanies[0]->companyUser->picture) }}" alt="プロフィール画像">
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
                    <td class="staff">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $project->project->projectPartners[0]->partner->picture) }}" alt="プロフィール画像">
                        </div> 
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
                    <td>¥{{ $project->project->budget }}</td>
                    <td>¥{{ $project->project->budget }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <!-- <div class="more-btn-container">
            <button id="partnerProjectShowMoreBtn">
                もっと見る
                <i class="fas fa-angle-down"></i>
            </button>
        </div> -->
        <div class="more-btn-container">
            <p id="partnerTaskShowMoreBtn" class="showmore">
                もっと見る
            </p>
        </div>
    </div>

    <div class="task-container">
        <div class="title-container">
            <h4>タスク</h4>
        </div>

        <table id="partner-task-table">
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
                    <td class="project_name">{{ $task->project->name }}</td>
                    <td>
                        <a href="task/{{ $task->id }}">
                            {{ $task->name }}</td>
                        </a>
                    <td class="staff">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $task->partner->picture) }}" alt="プロフィール画像">
                        </div> 
                            <p>{{ $task->partner->name }}</p>
                    </td>
                    <td>
                        @if($task->status == 0)
                            <p class="default">下書き</p>
                        @elseif ($task->status == 1)
                            <p class="default">タスク上長確認前</p>
                        @elseif ($task->status == 2)
                            <p class="default">タスク上長確認中</p>
                        @elseif ($task->status == 3)
                            <p class="default">タスクパートナー依頼前</p>
                        @elseif ($task->status == 4)
                            <p class="default">タスクパートナー依頼中</p>
                        @elseif ($task->status == 5)
                            <p class="default">発注書作成中</p>
                        @elseif ($task->status == 6)
                            <p class="default">発注書作成完了</p>
                        @elseif ($task->status == 7)
                            <p class="default">発注書上長確認中</p>
                        @elseif ($task->status == 8)
                            <p class="default">発注書パートナー依頼前</p>
                        @elseif ($task->status == 9)
                            <p class="default">発注書パートナー確認中</p>
                        @elseif ($task->status == 10)
                            <p class="default">作業中</p>
                        @elseif ($task->status == 11)
                            <p class="default">請求書依頼中</p>
                        @elseif ($task->status == 12)
                            <p class="default">請求書確認中</p>
                        @elseif ($task->status == 13)
                            <p class="done">完了</p>
                        @elseif ($task->status == 14)
                            <p class="default">キャンセル</p>
                        @endif
                    </td>
                    <td>¥{{ number_format($task->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-btn-container">
            <p id="partnerTaskShowMoreBtn" class="showmore">
                もっと見る
            </p>
        </div>
    </div>
</div>
@endsection
