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
                    <th>パートナー</th>
                    <th>タスク</th>
                    <th>期限</th>
                    <th>予算</th>
                    <th>請求額</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td class="project_name"><a href="{{ route('partner.project.show', ['project_id' => $project->project->id]) }}">{{ $project->project->name }}</a></td>
                    <td class="staff">
                        <div class="imgbox">
                            <img src="{{ $project->project->projectCompanies[0]->companyUser->picture }}" alt="プロフィール画像">
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
                    <td class="staff">
                        <div class="imgbox">
                            <img src="{{ $project->project->projectPartners[0]->partner->picture }}" alt="プロフィール画像">
                        </div> 
                        @if ($project->project->projectPartners->count() > 1) 
                            <p>
                                {{ $project->project->projectPartners[0]->partner->name }} 
                                他{{ $project->project->projectPartners->count() - 1 }}名
                            </p>
                        @else
                            <p>{{ $project->project->projectPartners[0]->partner->name }}</p>
                        @endif
                    </td>
                    <td><span class="underline">{{ $project->project->tasks->count() }}</span>件</td>
                    <td>{{ date("Y年m月d日", strtotime($project->project->ended_at)) }}</td>
                    <td>¥{{ $project->project->budget }}</td>
                    <td>¥{{ $project->project->budget }}</td>
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
                        @if($task->status == 0)
                            <p class="default">下書き</p>
                        @elseif ($task->status == 1)
                            <p class="default">タスク上長確認前</p>
                        @elseif ($task->status == 2)
                            <p class="default">タスク上長確認中</p>
                        @elseif ($task->status == 3)
                            <p class="default">タスクパートナー依頼前</p>
                        @elseif ($task->status == 4)
                            <p class="default">タスクパートナー依頼中</p>
                        @elseif ($task->status == 5)
                            <p class="default">発注書作成中</p>
                        @elseif ($task->status == 6)
                            <p class="default">発注書作成完了</p>
                        @elseif ($task->status == 7)
                            <p class="default">発注書上長確認中</p>
                        @elseif ($task->status == 8)
                            <p class="default">発注書パートナー依頼前</p>
                        @elseif ($task->status == 9)
                            <p class="default">発注書パートナー確認中</p>
                        @elseif ($task->status == 10)
                            <p class="default">作業中</p>
                        @elseif ($task->status == 11)
                            <p class="default">請求書依頼中</p>
                        @elseif ($task->status == 12)
                            <p class="default">請求書確認中</p>
                        @elseif ($task->status == 13)
                            <p class="done">完了</p>
                        @elseif ($task->status == 14)
                            <p class="default">キャンセル</p>
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
