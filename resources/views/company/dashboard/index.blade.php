@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/dashboard/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3>ダッシュボード</h3>
    </div>

    <div class="project-container table-container">
        <div class="title-container">
            <h4>プロジェクト</h4>
            <div class="btn-a-container">
                <a href="{{ route('company.project.create') }}">プロジェクト作成</a>
            </div>
        </div>

        <table class="project-container__table">
            <thead>
                <tr>
                    <th>プロジェクト</th>
                    <th>担当者</th>
                    <!-- <th>パートナー</th> -->
                    <th>タスク</th>
                    <th>期限</th>
                    <th>予算</th>
                    <th>請求額</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td class="project_name"><a href="{{ route('company.project.show', ['id' => $project->project->id]) }}">{{ $project->project->name }}</a></td>
                    <td>
                        <div class="imgbox">
                            <img src="{{ $project->project->projectCompanies[0]->companyUser->picture }}" alt="">
                        </div>                       
                        @if ($project->project->projectCompanies->count() > 1)
                            <p>
                                {{ $project->project->projectCompanies[0]->companyUser->name }} 
                                他{{ $project->project->projectCompanies->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->project->projectCompanies[0]->companyUser->name }}</p>
                        @endif
                    </td>
                    <!-- パートナー -->
                    <!-- <td></td> -->
                    <td><span>{{ $project->project->tasks->count() }}</span>件</td>
                    <td>
                        {{ date("Y年m月d日", strtotime($project->project->ended_at)) }}
                    </td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                    <td>¥{{ number_format($project->project->budget) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-container__wrapper">
            <p id="projectShowMoreBtn" class="showmore">もっと見る</p>
        </div>
    </div>

    <div class="taskStatus-container">
        <div class="title-container">
            <h4>ステータス</h4>
        </div>

        <div class="section-container">
            @for ($i = 0; $i < count($statusName_arr); $i++)
            <div class="status-card">
                <p class="key">{{ $statusName_arr[$i] }}</p>
                <p class="value">{{ $status_arr[$i] }}</p>
            </div>
            @endfor
        </div>
    </div>

    <div class="task-container table-container">
        <div class="title-container">
            <h4>タスク</h4>
            <div class="btn-a-container">
                <a href="{{ route('company.task.create') }}">タスク作成</a>
            </div>
        </div>

        <table class="task-container__table">
            <thead>
                <tr>
                    <th>プロジェクト</th>
                    <th>タスク</th>
                    <th>パートナー</th>
                    <th>ステータス</th>
                    <th>請求額</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td class="project_name">{{ $task->project->name }}</td>
                    <td><a href="{{ route('company.task.show', ['id' => $task->id]) }}">{{ $task->name }}</a></td>
                    <td class="partner">
                        <div class="imgbox">
                            <img src="{{ $task->partner->picture }}" alt="">
                        </div>
                        <p>{{ $task->partner->name }}</p>
                    </td>
                    <td>
                        <div id ="state" class="status">
                            @if($task->status == 0)
                                <div class="color01">下書き</div>
                            @elseif($task->status == 1)
                                <div class="color01">タスク上長確認中</div>
                            @elseif($task->status == 2)
                                <div class="color01">タスクパートナー依頼前</div>
                            @elseif($task->status == 3)
                                <div class="color01">タスクパートナー確認中</div>
                            @elseif($task->status == 4)
                                <div class="color01">発注書作成前</div>
                            @elseif($task->status == 5)
                                <div class="color01">発注書上長確認中</div>
                            @elseif($task->status == 6)
                                <div class="color01">発注書パートナー依頼前</div>
                            @elseif($task->status == 7)
                                <div class="color01">発注書パートナー確認中</div>
                            @elseif($task->status == 8)
                                <div class="color01">作業前</div>
                            @elseif($task->status == 9)
                                <div class="color01">作業中</div>
                            @elseif($task->status == 10)
                                <div class="color01">検品中</div>
                            @elseif($task->status == 11)
                                <div class="color01">請求書作成前</div>
                            @elseif($task->status == 12)
                                <div class="color01">請求書下書き</div>
                            @elseif($task->status == 13)
                                <div class="color01">請求書担当者確認前</div>
                            @elseif($task->status == 14)
                                <div class="color01">請求書担当者確認中</div>
                            @elseif($task->status == 15)
                                <div class="color01">請求書経理提出</div>
                            @elseif($task->status == 16)
                                <div class="color01">請求書経理承認済み</div>
                            @elseif($task->status == 17)
                                <div class="color02">完了</div>
                            @elseif($task->status == 18)
                                <div class="color03">キャンセル</div>
                            @endif
                        </div>
                    </td>
                    <td>¥{{ number_format($task->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-container__wrapper">
            <p id="taskShowMoreBtn" class="showmore">もっと見る</p>
        </div>


    </div>
</div>
@endsection
