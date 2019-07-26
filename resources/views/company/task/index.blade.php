@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/index.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $company_user->name }}
</div>
<div class="navbar-item">
    <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
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
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task" class="isActive"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
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
        <!-- page header -->
        <div class="top-container">
            <div class="page-title-container">
                <div class="page-title-container__page-title">タスク</div>
            </div>
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
                    @for($i = 0; $i < 10; $i++)
                        <li class="parts-container__wrapper"> 
                            <!-- ステータス名表示 -->
                            <div class="parts-container__wrapper__textdisplayarea">
                                <div class="parts-container__wrapper__textdisplayarea__textdisplay">
                                    <div class="parts-container__wrapper__textdisplayarea__textdisplay__text">
                                        {{ $statusName_arr[$i] }}
                                    </div>
                                </div>
                            </div>
                            <!-- ステータス表示数部分 -->
                            
                            <div class="parts-container__wrapper__numberdisplayarea">

                                <div class="parts-container__wrapper__numberdisplayarea__numberdisplay">
                                    <div class="parts-container__wrapper__numberdisplayarea__numberdisplay__number">
                                        {{ $status_arr[$i] }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <!-- Task -->
        <div class="task-container">
            <ul id="tab-button" class="tab-button">
                <li class="all"><a href="#tab01">タスク一覧</a></li>
                <li class="done"><a href="#tab02">完了したタスク</a></li>
            </ul>
            <div class="task-container__createarea">
                <div class="task-container__createarea__buttonarea control">
                    <button class="task-container__createarea__buttonarea__button button"><a href="/company/task/create">タスク作成</a></button>
                </div>
            </div>
            <div class="task-container__wrapper">
                <!-- タイトル -->
                <div class="item-name-select-wrapper">
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">タスク</div>
                    </div>
                    <div class="selectWrap">
                        <select class="select" name="" id="">
                            <option value="">全てのステータス</option>
                            <option value="">下書き</option>
                            <option value="">提案中</option>
                            <option value="">依頼前</option>
                            <option value="">依頼中</option>
                            <option value="">開始前</option>
                            <option value="">作業中</option>
                            <option value="">提出前</option>
                            <option value="">修正中</option>
                            <option value="">完了</option>
                            <option value="">キャンセル</option>
                        </select>
                    </div>
                </div>
                
                <div class="task-container__wrapper__table-wrapper">
                    <table class="task-container__wrapper__table-wrapper__table">
                        <!-- タイトルヘッダー部分 -->
                        <tr class="task-container__wrapper__table-wrapper__table__headerrow">
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">プロジェクト</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">タスク</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">パートナー</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">ステータス</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">請求額</th>
                            <th class="task-container__wrapper__table-wrapper__table__headerrow__tableheader">ステータス変更</th>
                        </tr>
                        <!-- テーブルデータ部分 -->
                        @foreach($tasks as $task)
                        <tr class="task-container__wrapper__table-wrapper__table__datarow">
                            
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata  project">{{ $task->project->name }}</td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata"><a href="task/{{ $task->id }}">{{ $task->name }}</a></td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">
                                    @foreach($task->taskPartners as $taskPartner)
                                        {{ $taskPartner->partner->name }}
                                    @endforeach
                                </td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">
                                    <div class="task-container__wrapper__table-wrapper__table__datarow__tabledata__statusaction">
                                        <div id ="state" class="task-container__wrapper__table-wrapper__table__datarow__tabledata__statusaction__status">
                                            @if($task->status == 0)
                                                <div class="color01">下書き</div>
                                            @elseif($task->status == 1)
                                                <div class="color01">提案中</div>
                                            @elseif($task->status == 2)
                                                <div class="color01">依頼前</div>
                                            @elseif($task->status == 3)
                                                <div class="color01">依頼中</div>
                                            @elseif($task->status == 4)
                                                <div class="color01">開始前</div>
                                            @elseif($task->status == 5)
                                                <div class="color01">作業中</div>
                                            @elseif($task->status == 6)
                                                <div class="color01">提出前</div>
                                            @elseif($task->status == 7)
                                                <div class="color01">修正中</div>
                                            @elseif($task->status == 8)
                                                <div class="color02">完了</div>
                                            @elseif($task->status == 9)
                                                <div class="color02">完了</div>
                                            @elseif($task->status == 10)
                                                <div class="color03">キャンセル</div>
                                            @endif    
                                   
                                        </div>
                                    </div>
                                </td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata">¥{{ $task->price }}</td>
                                <td class="task-container__wrapper__table-wrapper__table__datarow__tabledata"><button><a href="">完了</a></button></td>
                        </tr>
                        @endforeach
                    </table>
                        <!-- Show More部分 -->
                        <div class="task-container__wrapper__table-wrapper__more">
                            <div class="task-container__wrapper__table-wrapper__more__area">
                                <!-- <p @click="showMoreTask(4)" class="task-container__wrapper__table-wrapper__more__area__showmore" >Show More</p> -->
                                <p class="task-container__wrapper__table-wrapper__more__area__showmore" >もっと見る</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
