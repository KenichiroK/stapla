@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/task/show/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    @if (session('completed'))
    <div class="complete-container">
        <p>{{ session('completed') }}</p>
    </div>
    @endif

    <div class="page-title-container">
        <h3 class="page-title-container__text">タスク詳細</h3>
        <a class="page-title-container__btn" href="{{ route('company.task.edit', ['id' => $task->id]) }}">タスク編集</a>
    </div>

    <div class="navbar-container">
        <div class="border-container">
            <div class="{{ $task->status < config('const.WORKING') ? 'navbar-container__item is-active' : 'navbar-container__item'}}">
                <p class="navbar-container__item--step">Step1</p>
                <p class="navbar-container__item--text">タスク・発注書</p>
            </div>
        </div>
        <div class="border-container">
            <div class="{{ $task->status >= config('const.WORKING') && $task->status < config('const.ACCEPTANCE') ? 'navbar-container__item is-active' : 'navbar-container__item'}}">
                <p class="navbar-container__item--step">Step2</p>
                <p class="navbar-container__item--text">作業中</p>
            </div>
        </div>
        <div class="border-container">
            <div class="{{ $task->status >= config('const.ACCEPTANCE') && $task->status < config('const.COMPLETE_STAFF') ? 'navbar-container__item is-active' : 'navbar-container__item'}}">
                <p class="navbar-container__item--step">Step3</p>
                <p class="navbar-container__item--text">請求書</p>
            </div>
        </div>
        <div class="border-container">
            <div class="{{ $task->status >= config('const.COMPLETE_STAFF') ? 'navbar-container__item is-active' : 'navbar-container__item'}}">
                <p class="navbar-container__item--step">Step4</p>
                <p class="navbar-container__item--text">完了</p>
            </div>
        </div>
    </div>

    @if ($alert_next_action_user)
    <div class="alert-container">
       <span class="alert-container__alert">要対応</span><p class="alert-container__text">内容を確認し問題なければ、{{ $alert_next_action_user }}してください。</p>
    </div>
    @endif

    <div class="items-container">
        <div class="item-container">
            <p class="item-container__left">プロジェクト名</p>
            <p class="item-container__right">{{ $task->project->name }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">タスク作成日</p>
            <p class="item-container__right">{{ date('Y年m月d日', strtotime($task->created_at)) }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">タスク内容</p>
            <p class="item-container__right">{{ $task->content }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">ステータス</p>
            <p class="item-container__right">
                @if ($alert_next_action_user)
                <span class="item-container__right--alert">要対応</span>
                @endif
                {{ config('const.TASK_STATUS_LIST')[$task->status] }}
            </p>
        </div>

        <div class="item-container">
            <p class="item-container__left">担当者</p>
            <div class="item-container__right">
                <div class="item-container__right--user">
                    <img class="item-container__right--user--img" src="{{ $task->companyUser->picture }}" alt="">
                    <p class="item-container__right--user--name">{{ $task->companyUser->name }}</p>
                </div>
            </div>
        </div>

        <div class="item-container">
            <p class="item-container__left">上長</p>
            <div class="item-container__right">
                <div class="item-container__right--user">
                    <img class="item-container__right--user--img" src="{{ $task->superior->picture }}" alt="">
                    <p class="item-container__right--user--name">{{ $task->superior->name }}</p>
                </div>
            </div>
        </div>

        <div class="item-container">
            <p class="item-container__left">経理</p>
            <div class="item-container__right">
                <div class="item-container__right--user">
                    <img class="item-container__right--user--img" src="{{ $task->accounting->picture }}" alt="">
                    <p class="item-container__right--user--name">{{ $task->accounting->name }}</p>
                </div>
            </div>
        </div>

        <div class="item-container">
            <p class="item-container__left">プロジェクト期間</p>
            <p class="item-container__right">{{ date('Y年m月d日', strtotime($task->started_at)) }}<span class="date-line"></span>{{ date('Y年m月d日', strtotime($task->ended_at)) }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">予算</p>
            <p class="item-container__right">￥{{ number_format($task->budget) }}</p>
        </div>
    </div>

    <div class="items-container">
        <div class="item-title-container">
            <p class="item-title-container__text">パートナー契約内容</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">パートナー</p>
            <div class="item-container__right">
                <div class="item-container__right--user">
                    <img class="item-container__right--user--img" src="{{ $task->partner->picture }}" alt="">
                    <p class="item-container__right--user--name">{{ $task->partner->name }}</p>
                </div>
            </div>
        </div>

        <div class="item-container">
            <p class="item-container__left">報酬形式</p>
            <p class="item-container__right">{{ $task->fee_format }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">発注単価 (税抜)</p>
            <p class="item-container__right">￥{{ number_format($task->price) }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">発注件数</p>
            <p class="item-container__right">{{ $task->fee_format }}</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">発注額</p>
            <p class="item-container__right">￥{{ number_format($task->price * (1 + $task->tax)) }}</p>
        </div>
    </div>

    @if($task->status >= config('const.DELIVERY_PARTNER'))
    <div class="items-container">
        <div class="item-title-container">
            <p class="item-title-container__text">納品</p>
        </div>

        <div class="item-container">
            <p class="item-container__left">自由記述</p>
            <p class="item-container__right">
                @isset($task->deliver)
                {!! nl2br(e($deliver->deliver_comment)) !!}
                @endisset
            </p>
        </div>

        <div class="item-container">
            <p class="item-container__left">ファイル納品</p>
            <p class="item-container__right">
                @isset($task->deliver)
                @for( $n=0; $n < count( $deliver->deliverItems); $n++)
                <form action="{{ route('company.fileDownload') }}" method="post">
                    @csrf
                    <input type="hidden" name="file" value="{{  $deliver->deliverItems[$n]->file }}"><br />
                    <button>{{ explode('/',  $deliver->deliverItems[$n]->file)[5] }}</button>
                </form>
                @endfor
                @endisset
            </p>
        </div>
    </div>
    @endif

    @include('company.task.show.components.actionButton')
</div>
@endsection
