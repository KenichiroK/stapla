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
            <div class="button-wrapper">
                <a href="{{ route('company.task.edit', ['id' => $task->id]) }}" class="button-wrapper__btn button">編集</a>
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
                    {{ date("Y年m月d日H時i分", strtotime($task->created_at)) }}
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
                    <div class="person-item">
                        <div class="imgbox">
                            <img src="{{ $task->companyUser->picture }}" alt="担当者プロフィール画像">
                        </div>
                        <p>{{ $task->companyUser->name }}</p>
                    </div>
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
                    {{ number_format($task->price) }}円
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
                    @if(($task->status) === config('const.TASK_CREATE'))
                        下書き
                    @elseif(($task->status) === config('const.TASK_SUBMIT_SUPERIOR'))
                        タスク上長確認中
                    @elseif(($task->status) === config('const.TASK_APPROVAL_SUPERIOR'))
                        タスクパートナー依頼前
                    @elseif(($task->status) === config('const.TASK_SUBMIT_PARTNER'))
                        タスクパートナー確認中
                    @elseif(($task->status) === config('const.TASK_APPROVAL_PARTNER'))
                        発注書作成前
                    @elseif(($task->status) === config('const.ORDER_SUBMIT_SUPERIOR'))
                        発注書上長確認中
                    @elseif(($task->status) === config('const.ORDER_APPROVAL_SUPERIOR'))
                        発注書パートナー依頼前
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
                    @elseif(($task->status) === config('const.INVOICE_CREATE'))
                        請求書担当者確認前
                    @elseif(($task->status) === config('const.SUBMIT_STAFF'))
                        請求書担当者確認中
                    @elseif(($task->status) === config('const.SUBMIT_ACCOUNTING'))
                        請求書経理確認中
                    @elseif(($task->status) === config('const.APPROVAL_ACCOUNTING'))
                        請求書経理承認済み
                    @elseif(($task->status) === config('const.COMPLETE_STAFF'))
                        完了
                    @elseif(($task->status) === config('const.TASK_CANCELED'))
                        キャンセル
                    @endif
                </dd>
            </dl>
        </div>

        @if($task->status >= 10)
            <div class="patner">
                <p class="ptnr-title">納品</p>
                <dl>
                    <dt>
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
                            <form action="{{ route('company.fileDownload') }}" method="post">
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
            @if($task->status === config('const.TASK_CREATE'))
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.TASK_SUBMIT_SUPERIOR') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">上長に確認を依頼する</button>
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
                                    <p class="text-center">タスクを新規作成し 、 {{ $task->superior->name }} さんに上長確認を依頼します。</p>
                                    <p class="text-center">よろしいですか？</p>
                                </div>
                                <div class="modal-footer center-block  border border-0">
                                    <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >依頼</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($task->status === config('const.TASK_SUBMIT_SUPERIOR') && $task->superior->id === $auth->id)
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.TASK_CREATE') }}">
                    <button type="submit" class="undone">タスクを承認しない</button>
                </form>
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.TASK_APPROVAL_SUPERIOR') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">タスクを承認する</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
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
            @elseif($task->status === config('const.TASK_APPROVAL_SUPERIOR') && in_array($auth->id, $company_user_ids))
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.TASK_SUBMIT_PARTNER') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">パートナーに依頼する</button>
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
                                    <p class="text-center">パートナーの {{ $task->partner->name }} さんに確認依頼します。</p>
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
            @elseif($task->status === config('const.TASK_APPROVAL_PARTNER') && in_array($auth->id, $company_user_ids))
                <a href="{{ route('company.document.purchaseOrder.create', ['id' => $task->id]) }}" class="done">発注書を作成する</a>
            @elseif($task->status === config('const.ORDER_SUBMIT_SUPERIOR') && $task->superior->id === $auth->id)
                <a class="done" href="{{ route('company.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}">発注書を確認する</a>
            @elseif($task->status === config('const.ORDER_APPROVAL_SUPERIOR') && in_array($auth->id, $company_user_ids))
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.ORDER_SUBMIT_PARTNER') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">発注書をパートナーに依頼する</button>
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
                                    <p class="text-center">パートナーの {{ $task->partner->name }} さんに確認依頼します。</p>
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
            @elseif($task->status === config('const.DELIVERY_PARTNER') && in_array($auth->id, $company_user_ids))
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.WORKING') }}">
                    <button type="button" class="undone confirm" data-toggle="modal" data-target="#corrected">再納品を依頼</button>
                    <!-- Modal -->
                    <div class="modal fade" id="corrected" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-header border border-0">
                                    <h5 class="center-block" id="exampleModalLabel">確認</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">修正を依頼します。</p>
                                    <p class="text-center">よろしいですか？</p>
                                </div>
                                <div class="modal-footer center-block  border border-0">
                                    <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >依頼</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.ACCEPTANCE') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#accept">検収</button>
                    <!-- Modal -->
                    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-header border border-0">
                                    <h5 class="center-block" id="exampleModalLabel">確認</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">検品完了します。</p>
                                    <p class="text-center">よろしいですか？</p>
                                </div>
                                <div class="modal-footer center-block  border border-0">
                                    <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >完了</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($task->status === config('const.INVOICE_CREATE') && in_array($auth->id, $company_user_ids))
                <a href="{{ route('company.document.invoice.show', ['id' => $invoice->id]) }}" class="done">請求書を確認する</a>
            @elseif($task->status === config('const.SUBMIT_ACCOUNTING') && $task->accounting->id === $auth->id)
                <a href="{{ route('company.document.invoice.show', ['id' => $invoice->id]) }}" class="done">請求書を確認する</a>
            @elseif($task->status === config('const.APPROVAL_ACCOUNTING') && in_array($auth->id, $company_user_ids))
                <form action="{{ route('company.task.status.change') }}" method="POST">
                @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="status" value="{{ config('const.COMPLETE_STAFF') }}">
                    <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">タスクを完了にする</button>
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
                                    <p class="text-center">タスクを完了します。</p>
                                    <p class="text-center">よろしいですか？</p>
                                </div>
                                <div class="modal-footer center-block  border border-0">
                                    <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >完了</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($task->status === config('const.COMPLETE_STAFF'))
                <p class="non-action-text">このタスクは完了しています</p>
            @elseif($task->status === config('const.TASK_CANCELED'))
                <p class="non-action-text">このタスクはキャンセルされています</p>
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
    </div>
</div>
@endsection