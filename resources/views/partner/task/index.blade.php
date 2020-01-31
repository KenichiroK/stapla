@extends('partner.index')

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
                        
                        <!-- <a href=""> -->
                            <li class="parts-container__wrapper">
                            <a href="">
                                <!-- ステータス名表示 -->
                                <div class="textdisplay">
                                    <div class="text">
                                        下書き
                                    </div>
                                </div>
                                <!-- ステータス表示数部分 -->
                                <div class="numberdisplay">
                                    <div class="t-number">
                                        0
                                    </div>
                                </div>
                            </a>
                            </li>
                        <!-- </a> -->
                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- Task -->
        <div class="task-container">
            <ul id="tab-button" class="tab-button">
                <li id="non_complete_label" class="all"><a href="{{ route('partner.task.index') }}">タスク一覧</a></li>
                <li id="complete_label" class="done"><a href="{{ route('partner.task.status', ['task_status' => 17 ]) }}">完了したタスク</a></li>
            </ul>

            <div class="task-container__wrapper">
                <!-- タイトル -->
                    <div class="item-name-select-wrapper">
                        <div class="item-name-wrapper">
                            <div class="item-name-wrapper__item-name">タスク</div>
                        </div>
                        <!-- <div class="selectWrap">
                            <select class="select" name="" id="">
                                <option value="">全てのステータス</option>
                                <option value="">下書き</option>
                                <option value="">タスク上長確認前</option>
                                <option value="">上長確認中</option>
                                <option value="">パートナー依頼前</option>
                                <option value="">タスクパートナー依頼中</option>
                                <option value="">発注書作成中</option>
                                <option value="">発注書作成完了</option>
                                <option value="">上長確認中</option>
                                <option value="">パートナー依頼前</option>
                                <option value="">パートナー確認中</option>
                                <option value="">作業中</option>
                                <option value="">請求書依頼中</option>
                                <option value="">請求書確認中</option>
                                <option value="">完了</option>
                                <option value="">キャンセル</option>
                            </select>
                        </div> -->
                    </div>
                
                    <div class="table-wrapper">
                        <table>
                            <!-- タイトルヘッダー部分 -->
                            <tr class="headerrow">
                                <th>プロジェクト</th>
                                <th>タスク</th>
                                <th>担当者</th>
                                <th>ステータス</th>
                                <th>請求額</th>
                            </tr>
                            <!-- テーブルデータ部分 -->
                            @foreach($tasks as $task)
                            <tr class="datarow">
                                <td class="project">{{ $task->project->name }}</td>
                                <td><a href="{{ route('partner.task.show', ['task_id' => $task->id]) }}">{{ $task->name }}</a></td>
                                <!-- <td>{{ $task->companyUser->name }}</td> -->
                                <td class="staff">
                                    <div class="imgbox">
                                        <img src="{{ $task->companyUser->picture }}" alt="プロフィール画像">
                                    </div> 
                                    <p>{{ $task->companyUser->name }}</p>
                                </td>
                                <td>
                                    <div id ="state" class="status">
                                        <div class="color02">
                                            @if($task->status === config('const.TASK_SUBMIT_PARTNER'))
                                                <div class="color01">パートナー確認中</div>
                                            @elseif($task->status === config('const.ORDER_SUBMIT_PARTNER'))
                                                <div class="color01">パートナー確認中</div>
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
                                            @elseif($task->status === config('const.COMPLETE_STAFF'))
                                                <div class="color02">完了</div>
                                            @elseif($task->status === config('const.TASK_CANCELED'))
                                                <div class="color03">キャンセル</div>
                                            @elseif($task->status >= config('const.TASK_APPROVAL_PARTNER'))
                                                <div class="color01">会社側対応中</div>
                                            @endif
                                        </div>
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
