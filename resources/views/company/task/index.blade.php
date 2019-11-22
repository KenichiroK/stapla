@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <!-- page header -->
        <div class="page-title-container">
            <div class="page-title">タスク</div>
        </div>
        <!-- ステータス -->
        <div class="status-container">
            <div class="status-container__wrapper">
                <!-- タイトル -->
                <div class="item-name-wrapper">
                    <div class="item-name-wrapper__item-name">ステータス</div>
                </div>
                <!-- ステータス表示部分 -->
                <div class="content">
                    <!-- ステータス各部分 -->
                    <ul class="parts-container">
                        @for($i = 0; $i < 14; $i++)
                        <!-- <a href="task/create"> -->
                            <li class="parts-container__wrapper">
                            <a href="{{ route('company.task.status.statusIndex', ['task_status' => $i ]) }}">
                                <!-- ステータス名表示 -->
                                <div class="textdisplay">
                                    <div class="text">
                                        {{ $statusName_arr[$i] }}
                                    </div>
                                </div>
                                <!-- ステータス表示数部分 -->
                                <div class="numberdisplay">
                                    <div class="t-number">
                                        {{ $status_arr[$i] }}
                                    </div>
                                </div>
                            </a>
                            </li>
                        <!-- </a> -->
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <!-- Task -->
        <div class="task-container">
            <ul id="tab-button" class="tab-button">
                <li id="non_complete_label" class="all"><a href="{{ route('company.task.index') }}">タスク一覧</a></li>
                <li id="complete_label" class="done"><a href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.COMPLETE_STAFF') ]) }}">完了したタスク</a></li>
            </ul>
            <div class="btn-a-container">
                <a href="{{ route('company.task.create') }}">タスク作成</a>
            </div>
            <div class="task-container__wrapper">
                <!-- タイトル -->
                    <div class="item-name-select-wrapper">
                        <div class="item-name-wrapper">
                            <div class="item-name-wrapper__item-name">タスク</div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <!-- タイトルヘッダー部分 -->
                            <tr class="headerrow">
                                <th>プロジェクト</th>
                                <th>タスク</th>
                                <th>担当者</th>
                                <th>パートナー</th>
                                <th>ステータス</th>
                                <th>請求額</th>
                            </tr>
                            <!-- テーブルデータ部分 -->
                            @foreach($tasks as $task)
                            <tr class="datarow">
                                <td class="project">{{ $task->project->name }}</td>
                                <td>
                                    @if($task->status === config('const.TASK_CREATE'))
                                        <a href="{{ route('company.task.temporary', ['task_id' => $task->id ]) }}">{{ $task->name }}</a>
                                    @else
                                        <a href="{{ route('company.task.show', ['id' => $task->id ]) }}">{{ $task->name }}</a>
                                    @endif
                                </td>
                                <td class="staff">
                                    <div class="imgbox">
                                        <img src="{{ $task->companyUser->picture }}" alt="プロフィール画像">
                                    </div> 
                                    <p>{{ $task->companyUser->name }}</p>
                                </td>
                                <td>
                                    @empty($task->partner_id)
                                    @else
                                        <div class="imgbox">
                                            <img src="{{ $task->partner->picture }}" alt="プロフィール画像">
                                        </div> 
                                        <p>{{ $task->partner->name }}</p>
                                    @endempty
                                </td>
                                <td>
                                    <div id ="state" class="status">
                                        @if($task->status === config('const.TASK_CREATE'))
                                            <div class="color01">下書き</div>
                                        @elseif($task->status === config('const.TASK_SUBMIT_SUPERIOR'))
                                            <div class="color01">タスク上長確認中</div>
                                        @elseif($task->status === config('const.TASK_APPROVAL_SUPERIOR'))
                                            <div class="color01">タスクパートナー依頼前</div>
                                        @elseif($task->status === config('const.TASK_SUBMIT_PARTNER'))
                                            <div class="color01">タスクパートナー確認中</div>
                                        @elseif($task->status === config('const.TASK_APPROVAL_PARTNER'))
                                            <div class="color01">発注書作成前</div>
                                        @elseif($task->status === config('const.ORDER_SUBMIT_SUPERIOR'))
                                            <div class="color01">発注書上長確認中</div>
                                        @elseif($task->status === config('const.ORDER_APPROVAL_SUPERIOR'))
                                            <div class="color01">発注書パートナー依頼前</div>
                                        @elseif($task->status === config('const.ORDER_SUBMIT_PARTNER'))
                                            <div class="color01">発注書パートナー確認中</div>
                                        @elseif($task->status === config('const.ORDER_APPROVAL_PARTNER'))
                                            <div class="color01">作業前</div>
                                        @elseif($task->status === config('const.WORKING'))
                                            <div class="color01">作業中</div>
                                        @elseif($task->status === config('const.DELIVERY_PARTNER'))
                                            <div class="color01">検品中</div>
                                        @elseif($task->status === config('const.ACCEPTANCE'))
                                            <div class="color01">請求書作成前</div>
                                        @elseif($task->status === config('const.INVOICE_DRAFT_CREATE'))
                                            <div class="color01">請求書下書き</div>
                                        @elseif($task->status === config('const.INVOICE_CREATE'))
                                            <div class="color01">請求書担当者確認前</div>
                                        @elseif($task->status === config('const.SUBMIT_STAFF'))
                                            <div class="color01">請求書担当者確認中</div>
                                        @elseif($task->status === config('const.SUBMIT_ACCOUNTING'))
                                            <div class="color01">請求書経理提出</div>
                                        @elseif($task->status === config('const.APPROVAL_ACCOUNTING'))
                                            <div class="color01">請求書経理承認済み</div>
                                        @elseif($task->status === config('const.COMPLETE_STAFF'))
                                            <div class="color02">完了</div>
                                        @elseif($task->status === config('const.TASK_CANCELED'))
                                            <div class="color03">キャンセル</div>
                                        @endif
                                    </div>
                                </td>
                                <td>¥{{ number_format($task->price) }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more__area">
                            <p id="task-index_showmore-btn" class="showmore" >もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("asset-js")
    <script src="{{ asset('js/common/task-status.js') }}" defer></script>
@endsection
