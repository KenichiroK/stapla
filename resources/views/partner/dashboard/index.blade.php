@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/dashboard/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3>ダッシュボード</h3>
    </div>

    <div class="project-container">
        <div class="title-container">
            <h4>プロジェクト</h4>
        </div>

        <table id="partner-project-table">
            <thead>
                <tr>
                    <th>プロジェクト</th>
                    <th>担当者</th>
                    <th>タスク</th>
                    <th>期限</th>
                    <th>予算</th>
                    <th>請求額</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td class="project_name"><a href="{{ route('partner.project.show', ['project_id' => $project->id]) }}">{{ $project->name }}</a></td>
                    <td class="staff">
                        <div class="imgbox">
                            <img src="{{ $project->projectCompanies[0]->companyUser->picture }}" alt="プロフィール画像">
                        </div> 
                        @if ($project->projectCompanies->count() > 1) 
                            <p>
                                {{ $project->projectCompanies[0]->companyUser->name }} 
                                他{{ $project->projectCompanies->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->projectCompanies[0]->companyUser->name }}</p>
                        @endif
                    </td>
                    <td><span class="underline">{{ $project->tasks->count() }}</span>件</td>
                    <td>{{ date("Y年m月d日", strtotime($project->ended_at)) }}</td>
                    <td>¥{{ $project->budget }}</td>
                    <td>¥{{ $project->price }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-btn-container">
            <p id="partnerProjectShowMoreBtn" class="showmore">
                もっと見る
            </p>
        </div>
    </div>

    <div class="task-container">
        <div class="title-container">
            <h4>タスク</h4>
        </div>

        <table id="partner-task-table">
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
                    <td>
                        <a href="{{ route('partner.task.show', ['task_id' => $task->id]) }}">
                            {{ $task->name }}</td>
                        </a>
                    <td class="staff">
                        <div class="imgbox">
                            <img src="{{ $task->partner->picture }}" alt="プロフィール画像">
                        </div> 
                            <p>{{ $task->partner->name }}</p>
                    </td>
                    <td>
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
                    </td>
                    <td>¥{{ number_format($task->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="more-btn-container">
            <p id="partnerTaskShowMoreBtn" class="showmore">
                もっと見る
            </p>
        </div>
    </div>
</div>
@endsection
