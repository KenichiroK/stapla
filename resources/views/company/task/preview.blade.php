@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/show.css') }}">
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
            <!-- <div class="button-wrapper">
                <button type='submit' class="button-wrapper__btn button">編集</button>
            </div> -->
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
                    {!! nl2br(e($task->content)) !!}
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
                                <img src="{{ $companyUser->companyUser->picture }}" alt="担当者プロフィール画像">
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
                            <img src="{{ $task->superior->picture }}" alt="上長プロフィール画像">
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
                            <img src="{{ $task->accounting->picture }}" alt="経理プロフィール画像">
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
                            <img src="{{ $task->partner->picture }}" alt="パートナープロフィール画像">
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
    </div>
</div>
@endsection
