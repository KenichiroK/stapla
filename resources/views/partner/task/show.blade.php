@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/task/show.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div class="top">
            @if(count($errors) > 0)
                <div class="error-container">
                    <p>入力に問題があります。再入力して下さい。</p>
                </div>
            @endif
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
                    @if(($task->status) === config('const.TASK_SUBMIT_PARTNER'))
                        タスクパートナー確認中
                    @elseif(($task->status) === config('const.ORDER_SUBMIT_PARTNER'))
                        発注書パートナー確認中
                    @elseif(($task->status) === config('const.ORDER_APPROVAL_PARTNER'))
                        作業前
                    @elseif(($task->status) === config('const.WORKING'))
                        作業中
                    @elseif(($task->status) === config('const.DELIVERY_PARTNER'))
                        検品中
                    @elseif(($task->status) === config('const.ACCEPTANCE'))
                        請求書作成前
                    @elseif(($task->status) === config('const.INVOICE_DRAFT_CREATE'))
                        請求書下書き
                    @elseif(($task->status) === config('const.COMPLETE_STAFF'))
                        完了
                    @elseif(($task->status) === config('const.TASK_CANCELED'))
                        キャンセル
                    @elseif(($task->status) >= config('const.TASK_APPROVAL_PARTNER'))
                        会社側対応中
                    @endif
                </dd>
            </dl>
        </div>

        <!-- 納品のアップロードエリアは納品するとき($task->status === 9)の時のみ表示 -->
        @if( $task->status === config('const.WORKING') && $task->partner->id === Auth::user()->id )
            <form action="{{ route('partner.deliver.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="patner">
                    <p class="ptnr-title">納品</p>
                    <dl>
                        <dt class="textarea-wrp">
                            自由記述
                        </dt>
                        <dd>
                            <div class="textarea-wrp">
                                <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="deliver_comment" id="">{{ old('deliver_comment') }}</textarea>
                            </div>
                            @if ($errors->has('deliver_comment'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('deliver_comment') }}</strong>
                                    </div>
                                @endif
                        </dd>
                    </dl>

                    <dl>
                        <dt>
                            ファイル納品
                        </dt>
                        <dd class="upload-content">
                            <div class="upload-item">
                                <input type="file" name="deliver_files[]">
                            </div>
                            <div class="upload-item">
                                <input type="file" name="deliver_files[]">
                            </div>
                            <div class="upload-item">
                                <input type="file" name="deliver_files[]">
                            </div>
                            <p>（※ 1ファイル最大100MBまで）</p>
                            @if ($errors->has('deliver_files.*'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('deliver_files.*') }}</strong>
                                </div>
                            @endif
                        </dd>
                    </dl>
                </div>
                <div class="actionButton">
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.DELIVERY_PARTNER') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">納品する</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-header border border-0">
                                    <h5 class="center-block" id="exampleModalLabel">確認</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">納品します。</p>
                                    <p class="text-center">よろしいですか？</p>
                                </div>
                                <div class="modal-footer center-block  border border-0">
                                    <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >納品</button>
                                </div>
                            </div>
                        </div>
            <div>
            </form>
        @elseif( $task->status !== config('const.DELIVERY_PARTWORKINGNER') )
            <!-- 納品エリアは納品以降($task->status > 9)の時に表示 -->
            @if( $task->status > config('const.WORKING') )
                <div class="patner">
                    <p class="ptnr-title">納品</p>
                    <dl>
                        <dt class="textarea-wrp">
                            自由記述
                        </dt>
                        <dd class="flex01">
                            {!! nl2br(e($deliver->deliver_comment)) !!}
                        </dd>
                    </dl>

                    <dl>
                        <dt>
                            ファイル納品
                        </dt>
                        <dd>
                            @for( $n=0; $n < count($deliver_items); $n++)
                                <form action="{{ route('partner.fileDownload') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="file" value="{{ $deliver_items[$n]->file }}"><br />
                                    <button>{{ explode('/', $deliver_items[$n]->file)[5] }}</button>
                                </form>
                            @endfor     
                        </dd>
                    </dl>
                </div>
            @endif

            <div class="actionButton">
                @if($task->status === config('const.TASK_SUBMIT_PARTNER') && $task->partner->id === Auth::user()->id)
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="{{ config('const.TASK_CREATE') }}">
                        <button type="submit" class="undone">タスク依頼を受けない</button>
                    </form>
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="{{ config('const.TASK_APPROVAL_PARTNER') }}">
                        <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">タスク依頼を受ける</button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-header border border-0">
                                        <h5 class="center-block" id="exampleModalLabel">確認</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center">タスクを承認します。</p>
                                        <p class="text-center">よろしいですか？</p>
                                    </div>
                                    <div class="modal-footer center-block  border border-0">
                                        <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >承認</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @elseif($task->status === config('const.ORDER_SUBMIT_PARTNER') && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}" class="done">発注書を確認する</a>
                @elseif($task->status === config('const.ORDER_APPROVAL_PARTNER') && $task->partner->id === Auth::user()->id)
                    <form action="{{ route('partner.task.status.change') }}" method="POST">
                    @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="{{ config('const.WORKING') }}">
                        <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">作業に入る</button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-header border border-0">
                                        <h5 class="center-block" id="exampleModalLabel">確認</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center">作業を開始します。</p>
                                        <p class="text-center">よろしいですか？</p>
                                    </div>
                                    <div class="modal-footer center-block  border border-0">
                                        <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >承認</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @elseif($task->status === config('const.ACCEPTANCE') && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.invoice.create', ['task_id' => $task->id]) }}" class="done">請求書を作成する</a>
                @elseif($task->status === config('const.INVOICE_DRAFT_CREATE') && $task->partner->id === Auth::user()->id)
                    <a href="{{ route('partner.document.invoice.create', ['task_id' => $task->id]) }}" class="done">請求書を作成する</a>
                @elseif($task->status === config('const.COMPLETE_STAFF'))
                    <p class="non-action-text">このタスクは完了しています</p>
                @elseif($task->status === config('const.TASK_CANCELED'))
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
