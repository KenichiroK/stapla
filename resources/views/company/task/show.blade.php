@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/show.css') }}">
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
            <a href="/company/dashboard">
                <div class="menu__container--label">
                    <div class="menu-label">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                </div>
            </a>
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
                    <a href="/company/dashboard">
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products-active.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
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
                    <a href="/company/setting/general">
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
        @if (session('completed'))
            <div class="complete-container">
                <p>{{ session('completed') }}</p>
            </div>
        @endif
        <div class="top">
            <div class="page-title-container">
                <div class="page-title-container__page-title">タスク詳細</div>
            </div>
            <div class="button-wrapper">
                <button type='submit' class="button-wrapper__btn button">編集</button>
            </div>
        </div>

        <div class="detail">
            <dl class="first">
                <dt>
                    プロジェクト名
                </dt>
                <dd>
                    {{ $task->project->name }}
                </dd>
            </dl>
            <dl>
                <dt>
                    タスク作成日
                </dt>
                <dd>
                    {{ date("Y年m月d日", strtotime($task->created_at)) }}
                </dd>
            </dl>
            <dl>
                <dt>
                    タスク名
                </dt>
                <dd>
                    {{ $task->name }}
                </dd>
            </dl>
            <dl>
                <dt>
                    タスク内容
                </dt>
                <dd>
                    {{ $task->content }}
                </dd>
            </dl>
            <dl>
                <dt>
                    担当者
                </dt>
                <dd class="flex01">
                    @foreach($task->taskCompanies as $companyUser)
                        <div class="person-item">
                            <div class="imgbox">
                                <img src="/{{ str_replace('public/', 'storage/', $companyUser->companyUser->picture) }}" alt="担当者プロフィール画像">
                            </div>
                            <p>{{ $companyUser->companyUser->name }}</p>
                        </div>
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>
                    上長
                </dt>
                <dd class="flex01">
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $task->superior->picture) }}" alt="上長プロフィール画像">
                        </div>
                        <p>{{ $task->superior->name }}</p>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    経理
                </dt>
                <dd class="flex01">
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $task->accounting->picture) }}" alt="経理プロフィール画像">
                        </div>
                        <p>{{ $task->accounting->name }}</p>
                    </div>
                </dd>
            </dl>
            <dl class="term">
                <dt>
                    プロジェクト期間
                </dt>
                <dd>
                    <div class="flex01 term-desc">
                        <p class="start"><span>開始日</span>{{ date("Y年m月d日H時", strtotime($task->started_at)) }}</p>
                        <p><span>終了日</span>{{ date("Y年m月d日H時", strtotime($task->ended_at)) }}</p>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    予算
                </dt>
                <dd>
                    {{ number_format($task->budget) }}円
                </dd>
            </dl>
            <!-- <dl>
                <dt>
                    資料
                </dt>
                <dd>
                    
                </dd>
            </dl> -->
        </div>

        <div class="patner">
            <p class="ptnr-title">パートナー契約内容</p>
            <dl>
                <dt>
                    パートナー
                </dt>
                <dd class="flex01">
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $task->partner->picture) }}" alt="パートナープロフィール画像">
                        </div>
                        <p>{{ $task->partner->name }}</p>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    報酬形式
                </dt>
                <dd>
                    固定
                </dd>
            </dl>
            <dl>
                <dt>
                    発注単価<span>(税抜)</span>
                </dt>
                <dd>
                    {{ number_format($task->price) }}円
                </dd>
            </dl>
            <dl>
                <dt>
                    件数
                </dt>
                <dd>
                    {{ $task->cases }}件
                </dd>
            </dl>
            <dl>
                <dt>
                    発注額
                </dt>
                <dd class="orderprice">
                    <span class="tax">税込</span><span class="yen">￥</span>{{ number_format( ($task->price * $task->cases) * (1 + $task->tax)) }}
                </dd>
            </dl>
            <dl>
                <dt>
                    ステータス
                </dt>
                <dd class="status-desc">
                    @if(($task->status) === 0)
                        下書き
                    @elseif(($task->status) === 1)
                        タスク上長確認前
                    @elseif(($task->status) === 2)
                        タスク上長確認中
                    @elseif(($task->status) === 3)
                        タスクパートナー依頼前
                    @elseif(($task->status) === 4)
                        タスクパートナー依頼中
                    @elseif(($task->status) === 5)
                        発注書作成中
                    @elseif(($task->status) === 6)
                        発注書作成完了
                    @elseif(($task->status) === 7)
                        発注書上長確認中
                    @elseif(($task->status) === 8)
                        発注書パートナー依頼前
                    @elseif(($task->status) === 9)
                        発注書パートナー確認中
                    @elseif(($task->status) === 10)
                        作業中
                    @elseif(($task->status) === 11)
                        請求書依頼中
                    @elseif(($task->status) === 12)
                        請求書確認中
                    @elseif(($task->status) === 13)
                        完了
                    @elseif(($task->status) === 14)
                        キャンセル
                    @endif
                </dd>
            </dl>
        </div>
        
        <div class="actionButton">
            @if($task->status === 1 && in_array($company_user->id, $company_user_ids))
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="2">
                    <button type="submit" class="done">上長に確認を依頼する</button>
                </form>
            @elseif($task->status === 2 && $task->superior->id === $company_user->id)
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="undone">タスクを承認しない</button>
                </form>
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="3">
                    <button type="submit" class="done">タスクを承認する</button>
                </form>
            @elseif($task->status === 3 && in_array($company_user->id, $company_user_ids))
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="4">
                    <button type="submit" class="done">パートナーに依頼する</button>
                </form>
            @elseif($task->status === 5 && in_array($company_user->id, $company_user_ids))
                <a href="/company/document/purchaseOrder/create/{{ $task->id }}" class="done">発注書を作成する</a>
            @elseif($task->status === 6 && in_array($company_user->id, $company_user_ids))
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="7">
                    <button type="submit" class="done">発注書の確認を上長に依頼する</button>
                </form>
            @elseif($task->status === 7 && $task->superior->id === $company_user->id)
                <a class="done" href="/company/document/purchaseOrder/{{ $purchaseOrder->id }}">発注書を確認する</a>
            @elseif($task->status === 8 && in_array($company_user->id, $company_user_ids))
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="9">
                    <button type="submit" class="done">発注書をパートナーに依頼する</button>
                </form>
            @elseif($task->status === 10 && in_array($company_user->id, $company_user_ids))
                <form action="{{ url('company/task/status') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="11">
                    <button type="submit" class="done">請求書を依頼する</button>
                </form>
            @elseif($task->status === 12 && in_array($company_user->id, $company_user_ids))
                <a href="/company/document/invoice/{{ $invoice->id }}" class="done">請求書を確認する</a>
            @elseif($task->status === 13)
                <p class="non-action-text">このタスクは完了しています</p>
            @else
                <p class="non-action-text">必要なアクションはありません</p>
            @endif
        </div>

    </div>
</div>
@endsection
