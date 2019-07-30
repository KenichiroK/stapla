@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/show.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $partner->name }}
</div>
<div class="navbar-item">
    <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
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
                <li><a href="/partner/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="#"  class="isActive"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/invoice/create"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/partner/setting/invoice"><i class="fas fa-cog"></i>設定</a></li>
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
                    {{ explode(' ', $task->created_at)[0] }}
                </dd>
            </dl>
            <dl>
                <dt>
                    タスク内容
                </dt>
                <dd>
                    {{ $task->name }}
                </dd>
            </dl>
            <dl>
                <dt>
                    担当者
                </dt>
                <dd class="flex01">
                @foreach($task->taskCompanies as $taskCompany)
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $taskCompany->companyUser->picture) }}" alt="担当者プロフィール画像">
                        </div>
                        <p>{{ $taskCompany->companyUser->name }}</p>
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
                            <img src="/{{ str_replace('public/', 'storage/', $taskCompany->companyUser->picture) }}" alt="上長プロフィール画像">
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
                            <img src="/{{ str_replace('public/', 'storage/', $taskCompany->companyUser->picture) }}" alt="上長プロフィール画像">
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
                        <p class="start"><span>開始日</span>{{ explode(' ', $task->inspection_date)[0] }}</p>
                        <p><span>終了日</span>{{ explode(' ', $task->ended_at)[0] }}</p>
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
            <dl>
                <dt>
                    資料
                </dt>
                <dd>
                    
                </dd>
            </dl>
        </div>

        <div class="patner">
            <p class="ptnr-title">パートナー契約内容</p>
            <dl>
                <dt>
                    パートナー
                </dt>
                <dd class="flex01">
                @foreach($task->taskPartners as $taskPartner)
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="/{{ str_replace('public/', 'storage/', $taskCompany->companyUser->picture) }}" alt="パートナープロフィール画像">
                        </div>
                        <p>{{ $taskPartner->partner->name }}</p>
                    </div>
                @endforeach
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
                    {{ number_format($task->budget) }}円
                </dd>
            </dl>
            <dl>
                <dt>
                    件数
                </dt>
                <dd>
                    {{ $task->project->tasks->count() }}件
                </dd>
            </dl>
            <dl>
                <dt>
                    発注額
                </dt>
                <dd class="orderprice">
                    <span class="tax">税込</span><span class="yen">￥</span>{{ number_format($task->price * (1 + $task->tax)) }}
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
                        提案中
                    @elseif(($task->status) === 2)
                        依頼前
                    @elseif(($task->status) === 3)
                        依頼中
                    @elseif(($task->status) === 4)
                        開始前
                    @elseif(($task->status) === 5)
                        作業中
                    @elseif(($task->status) === 6)
                        提出前
                    @elseif(($task->status) === 7)
                        修正中
                    @elseif(($task->status) === 8)
                        完了
                    @elseif(($task->status) === 9)
                        キャンセル
                    @endif
                </dd>
            </dl>
        </div>
        
    </div>
</div>
@endsection
