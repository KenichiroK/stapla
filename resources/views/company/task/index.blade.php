@extends('index')

@section('sidebar')

<div class="sidebar__container">
        <div class="sidebar__container__wrapper">
            <aside class="menu menu__container">
                <div class="menu__container--label">
                    <div class="menu-label">
                        fms
                    </div>
                </div>
                <ul class="menu-list menu menu__container__menu-list">
                    <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                    <li><a href="/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                    <li><a href="/task"><i class="fas fa-tasks"></i>タスク</a></li>
                    <li><a href="/document"><i class="fas fa-newspaper"></i>書類</a></li>
                    <li><a href="#"><i class="fas fa-user-circle"></i>パートナー</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                    <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
                </ul>
            </aside>
        </div>
    </div>

@endsection

@section('content')
<div>


</div>
<div class="main__container">
        <div class="main__container__wrapper">
            <!-- page header -->
            <div class="top-container">
        <div class="page-title-container">
            <div class="page-title-container__page-title">タスク一覧</div>
        </div>
        <div class="field top-container__field">
            <p class="control has-icons-left top-container__field__control">
                <input class="input top-container__field__control__input" placeholder="Search Name...">
                <span class="icon is-small is-left">
                    <i class="fas fa-search"></i>
                </span>
            </p>
        </div>
        <!-- <div class="top-container__searcharea field">
            <input class="input font-awesome" type="text" placeholder="Search Name…">
        </div> -->
        <div class="top-container__createarea">
            <div class="top-container__createarea__buttonarea control">
                <button class="top-container__createarea__buttonarea__button button"><a href="task/create">タスク作成</a></button>
            </div>
        </div>
    </div>
            <!-- ステータス -->
            <div class="status-container">
                <div class="status-container__wrapper">
                    <!-- タイトル -->
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__title-name">ステータス</div>
                    </div>
                    <!-- ステータス表示部分 -->
                    <div class="content">
                        <!-- ステータス各部分 -->
                        <div class="parts-container">
                        @for($i = 0; $i < 10; $i++)
                            <div class="parts-container__wrapper"> 
                                <!-- ステータス表示数部分 -->
                                
                                <div class="parts-container__wrapper__numberdisplayarea">

                                    <div class="parts-container__wrapper__numberdisplayarea__numberdisplay">
                                        <div class="parts-container__wrapper__numberdisplayarea__numberdisplay__number">
                                            {{ $status_arr[$i] }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- ステータス名表示 -->
                                <div class="parts-container__wrapper__textdisplayarea">
                                    <div class="parts-container__wrapper__textdisplayarea__textdisplay">
                                        <div class="parts-container__wrapper__textdisplayarea__textdisplay__text">
                                            {{ $statusName_arr[$i] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="next">
                            </div>
                            @endfor 
                            <!-- 次へ -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Task -->
            <div class="task-container">
                <div class="task-container__wrapper">
                    <!-- タイトル -->
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">Task</div>
                    </div>
                    <div class="task-container__wrapper__table-wrapper">
                    <table class="task-container__wrapper__table-wrapper__table">
                        <!-- タイトルヘッダー部分 -->
                        <tr class="task-container__wrapper__table-wrapper__table__headerrow">
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">タスク</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">プロジェクト<i class="task-container__table__headerrow__tableheader__arrow fas fa-angle-down"></i></th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">パートナー</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">期限</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">ステータス<i class="task-container__table__headerrow__tableheader__arrow fas fa-angle-down"></i></th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">請求額</th>
                        </tr>
                        <!-- テーブルデータ部分 -->
                        @foreach($tasks as $task)
                        <tr class="task-container__wrapper__table-wrapper__table__datarow">
                            
                                
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata"><a href="task/detail">{{ $task->name }}</a></td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">{{ $task->project->name }}</td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">
                                    @foreach($task->taskPartners as $taskPartner)
                                        {{ $taskPartner->partner->name }}
                                    @endforeach
                                </td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">{{ $task->ended_at }}</td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">
                                    <div class="task-container__wrapper__table-wrapper__table__datarow__tabledata__statusaction">
                                        <div id ="state" class="task-container__wrapper__table-wrapper__table__datarow__tabledata__statusaction__status">
                                            @if($task->status == 1)
                                                下書き
                                            @elseif($task->status == 2)
                                                提案中
                                            @elseif($task->status == 3)
                                                依頼前
                                            @elseif($task->status == 4)
                                                依頼中
                                            @elseif($task->status == 4)
                                                開始前
                                            @elseif($task->status == 5)
                                                作業中
                                            @elseif($task->status == 6)
                                                提出前
                                            @elseif($task->status == 7)
                                                修正中
                                            @elseif($task->status == 8)
                                                完了
                                            @else
                                                キャンセル
                                            @endif    
                                   
                                        </div>
                                    </div>
                                </td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">¥{{ $task->price }}</td>
                            
                        </tr>
                        @endforeach
                    </table>
                        <!-- Show More部分 -->
                        <div class="task-container__wrapper__table-wrapper__more">
                            <div class="task-container__wrapper__table-wrapper__more__area">
                                <!-- <p @click="showMoreTask(4)" class="task-container__wrapper__table-wrapper__more__area__showmore" >Show More</p> -->
                                <p class="task-container__wrapper__table-wrapper__more__area__showmore" >Show More</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection