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
                <li class="all isActive"><a href="{{ route('company.task.index') }}">タスク一覧</a></li>
                <li class="done"><a href="{{ route('company.task.status.statusIndex', ['task_status' => 13 ]) }}">完了したタスク</a></li>
            </ul>
            <div class="buttonarea control">
                <button class="c-button button"><a href="/company/task/create">タスク作成</a></button>
            </div>
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
                                <option value="">タスク上長確認中</option>
                                <option value="">タスクパートナー依頼前</option>
                                <option value="">タスクパートナー依頼中</option>
                                <option value="">発注書作成中</option>
                                <option value="">発注書作成完了</option>
                                <option value="">発注書上長確認中</option>
                                <option value="">発注書パートナー依頼前</option>
                                <option value="">発注書パートナー確認中</option>
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
                                <th>プロジェクト
                                    <span><i class="arrow fas fa-angle-up"></i><i class="arrow fas fa-angle-down"></i></span>
                                </th>
                                <th>タスク</th>
                                <th>パートナー</th>
                                <th>ステータス
                                    <span><i class="arrow fas fa-angle-up"></i><i class="arrow fas fa-angle-down"></i></span>
                                </th>
                                <th>請求額
                                    <span><i class="arrow fas fa-angle-up"></i><i class="arrow fas fa-angle-down"></i></span>
                                </th>
                            </tr>
                            <!-- テーブルデータ部分 -->
                            @foreach($tasks as $task)
                            <tr class="datarow">
                                <td class="project">{{ $task->project->name }}</td>
                                <td><a href="task/{{ $task->id }}">{{ $task->name }}</a></td>
                                <td>{{ $task->partner->name }}</td>
                                <td>
                                    <div id ="state" class="status">
                                        @if($task->status == 0)
                                            <div class="color01">下書き</div>
                                        @elseif($task->status == 1)
                                            <div class="color01">タスク上長確認前</div>
                                        @elseif($task->status == 2)
                                            <div class="color01">タスク上長確認中</div>
                                        @elseif($task->status == 3)
                                            <div class="color01">タスクパートナー依頼前</div>
                                        @elseif($task->status == 4)
                                            <div class="color01">タスクパートナー依頼中</div>
                                        @elseif($task->status == 5)
                                            <div class="color01">発注書作成中</div>
                                        @elseif($task->status == 6)
                                            <div class="color01">発注書作成完了</div>
                                        @elseif($task->status == 7)
                                            <div class="color01">発注書上長確認中</div>
                                        @elseif($task->status == 8)
                                            <div class="color01">発注書パートナー依頼前</div>
                                        @elseif($task->status == 9)
                                            <div class="color01">発注書パートナー確認中</div>
                                        @elseif($task->status == 10)
                                            <div class="color01">作業中</div>
                                        @elseif($task->status == 11)
                                            <div class="color01">請求書依頼中</div>
                                        @elseif($task->status == 12)
                                            <div class="color01">請求書確認中</div>
                                        @elseif($task->status == 13)
                                            <div class="color02">完了</div>
                                        @elseif($task->status == 14)
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
