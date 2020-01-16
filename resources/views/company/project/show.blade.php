@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
@endsection

@section('content')

<div class="main__container">
    <div class="main__container__wrapper">
        <div>
            @if (session('completed'))
                <div class="complete-container">
                    <p>{{ session('completed') }}</p>
                </div>
            @endif
            <div class="top-container">
                <h1 class="top-container__title">{{ $project->name }}詳細</h1>
                <a class="top-container__edit-btn" href="{{ route('company.project.edit', ['company_id' => $project->id] ) }}">
                    <div>編集</div>
                </a>
            </div>

            <div class="detail-container">
                <ul class="detail-container__list">
                    <li class="detail-container__list__item margin--none">
                        <div class="detail-container__list__item__name">プロジェクト名</div>
                        <p class="detail-container__list__item__content">{{ $project->name }}</p>
                    </li>
                    <li class="detail-container__list__item">
                        <div class="detail-container__list__item__name">プロジェクト詳細</div>
                        <p class="detail-container__list__item__content desc-item">{!! nl2br(e($project->detail)) !!}</p>
                    </li>
                    <li class="detail-container__list__item al-center">
                        <div class="detail-container__list__item__name">担当者</div>
                        <div class="detail-container__list__item__content">
                            @foreach($project->projectCompanies as $projectCompany)
                                <div class="staff-item">
                                    <div class="imgbox"><img src="{{ $projectCompany->companyUser->picture }}" alt=""></div>
                                    <p class="name">{{ $projectCompany->companyUser->name }}</p>
                                </div>
                            @endforeach
                        </div> 
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト期間</div>
                        <div class="period__wrapper">
                            <div class="period__wrapper__container">
                                <div class="period__wrapper__container__start">
                                    開始日
                                    <span class="period__wrapper__container__start__date">
                                        {{ date("Y年m月d日", strtotime($project->started_at)) }}
                                    </span>
                                </div>
                                <div class="period__wrapper__container__end">
                                    終了日
                                    <span class="period__wrapper__container__end__date">
                                        {{ $project->ended_at->format('Y年m月d日') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="detail-container__list__item">
                        <div class="detail-container__list__item__name">予算</div>
                        <div class="detail-container__list__item__content">{{ number_format($project->budget) }}円</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="task-container">
            <div class="task-container__item">
                <div class="task-container__item__wrap">
                    <h2 class="task-container__item__wrap__title">タスク</h2>
                    <div class="btn-a-container">
                        <a href="{{ route('company.task.create')}}?pid={{ $project->id }}">タスク作成</a>
                    </div>
                </div>
                <ul class="task-container__item__list">
                    <li>プロジェクト</li>
                    <li>タスク</li>
                    <li>パートナー</li>
                    <li>ステータス</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="task-container__content">
                @foreach ($tasks as $task)
                    <a class="task-show-link"
                        @if($task->status === config('const.TASK_CREATE'))
                            href="{{ route('company.task.createDraft', ['task_id' => $task->id ]) }}"
                        @else
                            href="{{ route('company.task.show', ['id' => $task->id ]) }}"
                        @endif
                    >
                        <ul class="task-item-list task-container__content__list">
                            <li class="task-name">{{ $task->project->name }}</li>
                            <li>{{ $task->name }}</li>
                            <li class="partner-item">
                            @isset($task->partner_id)
                                <div class="imgbox"><img src="{{ $task->partner->picture }}" alt=""></div>
                                <p class="name">
                                    {{ $task->partner->name }}</p>
                            @endisset
                            </li>
                            <li class="task-container__content__list__status">
                                <div
                                    @if($task->status === config('const.COMPLETE_STAFF'))
                                        class="s-btn done"
                                    @else
                                        class="s-btn"
                                    @endif
                                >
                                    {{ config('const.TASK_STATUS_LIST')[$task->status] }}
                                </div>
                            </li>
                            <li>¥{{ number_format($task->price) }}</li>
                        </ul>
                    </a> 
                @endforeach
            </div>

            <div class="task-container__content__showmore">
                <p id="showmore_task_btn" class="task-container__content__showmore__btn">もっと見る</p>
            </div>
        </div>

        @if($projectCompany->companyUser->id === Auth::id())
            <div class="actionButton">
                <form action="{{ route('company.project.complete', ['id' => $project->id, 'status' => $project->status]) }}" name="form1" method='POST' enctype="multipart/form-data">
                    @csrf

                    @if($finTasks === 0)
                        <p class="non-action-text">未完了タスクがあります。</p>
                    @elseif($project->status == config('const.PROJECT_CREATE'))

                        @foreach($tasks as $task)
                            
                            <input type="hidden" name="taskStatus[]" value="{{ $task->status }}">
                        @endforeach
                            <input type="hidden" class="undone"  name="projectStatus" value="{{ $project->status }}">
                            <button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">完了</button>
                            <!-- Modal -->
                            @component('components.confirm-modal')
                                @slot('modalID')
                                    confirm
                                @endslot
                                @slot('confirmBtnLabel')
                                    完了
                                @endslot
                                プロジェクトを完了します。
                            @endcomponent
                    @elseif($project->status == config('const.PROJECT_COMPLETE'))
                        <input type="hidden" name="projectStatus" value="{{ $project->status }}">
                        <button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">再オープン</button>
                        <!-- Modal -->
                        @component('components.confirm-modal')
                            @slot('modalID')
                                confirm
                            @endslot
                            @slot('confirmBtnLabel')
                                再オープン
                            @endslot
                            プロジェクトを再オープンします。
                        @endcomponent
                    @endif
                </form>
            
            </div>
        @endif

 
    </div>
</div>
@endsection