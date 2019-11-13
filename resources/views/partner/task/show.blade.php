@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/task/show.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div class="top">
            <div class="page-title-container">
                <div class="page-title-container__page-title">{{ $task->name }}詳細</div>
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
                <dd>{{ date("Y年m月d日H時i分", strtotime($task->created_at)) }}</dd>
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
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="{{ $task->companyUser->picture }}" alt="担当者プロフィール画像">
                        </div>
                        <p>{{ $task->companyUser->name }}</p>
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
                    発注単価<span>(税抜)</span>
                </dt>
                <dd>
                    {{ number_format($task->budget) }}円
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
                        タスク上長確認中
                    @elseif(($task->status) === 2)
                        タスクパートナー依頼前
                    @elseif(($task->status) === 3)
                        タスクパートナー確認中
                    @elseif(($task->status) === 4)
                        発注書作成前
                    @elseif(($task->status) === 5)
                        発注書上長確認中
                    @elseif(($task->status) === 6)
                        発注書パートナー依頼前
                    @elseif(($task->status) === 7)
                        発注書パートナー確認中
                    @elseif(($task->status) === 8)
                        作業前
                    @elseif(($task->status) === 9)
                        作業中
                    @elseif(($task->status) === 10)
                        検品中
                    @elseif(($task->status) === 11)
                        請求書作成前
                    @elseif(($task->status) === 12)
                        請求書下書き
                    @elseif(($task->status) === 13)
                        請求書担当者確認前
                    @elseif(($task->status) === 14)
                        請求書担当者確認中
                    @elseif(($task->status) === 15)
                        請求書経理提出
                    @elseif(($task->status) === 16)
                        請求書経理承認済み
                    @elseif(($task->status) === 17)
                        完了
                    @elseif(($task->status) === 18)
                        キャンセル
                    @endif
                </dd>
            </dl>
        </div>
        
        @if($task->status === 9 && $task->partner->id === Auth::user()->id)
            <form action="{{ route('partner.deliver.store') }}" enctype="multipart/form-data">
                <div class="patner">
                    <p class="ptnr-title">納品</p>
                    <dl>
                        <dt class="textarea-wrp">
                            自由記述
                        </dt>
                        <dd class="flex01 textarea-wrp">
                            <!-- <div class="textarea-wrp"> -->
                                
                                <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="" value="ファイルを選択" id="" cols="30" rows="10"></textarea>
                            <!-- </div> -->
                        </dd>
                    </dl>

                    <dl>
                        <dt>
                            ファイル納品
                        </dt>
                        <dd>
                            <input type="file" name="" id="">
                        </dd>
                    </dl>
                </div>
                <div class="actionButton">
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="10">
                    <button type="submit" class="done">納品する</button>
                <div>
            </form>
        @elseif($task->status >= 10)
            <div class="patner">
                <p class="ptnr-title">納品</p>
                <dl>
                    <dt class="textarea-wrp">
                        自由記述
                    </dt>
                    <dd class="flex01 textarea-wrp">
                        <!-- <div class="textarea-wrp"> -->
                            
                            <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="" value="ファイルを選択" id="" cols="30" rows="10"></textarea>
                        <!-- </div> -->
                    </dd>
                </dl>

                <dl>
                    <dt>
                        ファイル納品
                    </dt>
                    <dd>
                        <input type="file" name="" id="">
                    </dd>
                </dl>
            </div>

            <div class="actionButton">
                @if($task->status === 3 && $task->partner->id === Auth::user()->id)
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="0">
                        <button type="submit" class="undone">タスク依頼を受けない</button>
                    </form>
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="4">
                        <button type="submit" class="done">タスク依頼を受ける</button>
                    </form>
                @elseif($task->status === 7 && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}" class="done">発注書を確認する</a>
                @elseif($task->status === 8 && $task->partner->id === Auth::user()->id)
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="9">
                        <button type="submit" class="done">作業に入る</button>
                    </form>
                @elseif($task->status === 9 && $task->partner->id === Auth::user()->id)
                    <form action="{{ route('partner.deliver.store') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="10">
                        <button type="submit" class="done">納品する</button>
                    </form>
                @elseif($task->status === 11 && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.invoice.create', ['task_id' => $task->id]) }}" class="done">請求書を作成する</a>
                @elseif($task->status === 12 && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.invoice.create', ['task_id' => $task->id]) }}" class="done">請求書を作成する</a>
                @elseif($task->status === 17)
                    <p class="non-action-text">このタスクは完了しています</p>
                @elseif($task->status === 18)
                    <p class="non-action-text">このタスクはキャンセルされました</p>
                @else
                    <p class="non-action-text">必要なアクションはありません</p>
                @endif
            </div>
            <div class="error-message-wrapper">
                @if ($errors->has('task_id'))
                    <div class="error-msg" role="alert">
                        <strong>{{ $errors->first('task_id') }}</strong>
                    </div>
                @endif
                @if ($errors->has('status') && !$errors->has('task_id'))
                    <div class="error-msg" role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
