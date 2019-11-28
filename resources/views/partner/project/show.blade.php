@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div>
            <div class="top-container">
                <h1 class="top-container__title">{{ $project->name }}詳細</h1>
            </div>

            <div class="detail-container">
                <ul class="detail-container__list">
                    <li class="detail-container__list__item margin--none"><div class="detail-container__list__item__name">プロジェクト名</div> <p class="detail-container__list__item__content">{{ $project->name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト詳細</div><p class="detail-container__list__item__content desc-item">{!! nl2br(e($project->detail)) !!}</p></li>
                    <li class="detail-container__list__item al-center"><div class="detail-container__list__item__name">担当者</div>
                        <div class="detail-container__list__item__content">
                        {{ $project->task }}
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
                                <div class="period__wrapper__container__start">開始日<span class="period__wrapper__container__start__date">{{ date("Y年m月d日", strtotime($project->started_at)) }}</span></div>
                                <div class="period__wrapper__container__end">終了日<span class="period__wrapper__container__end__date">{{ date("Y年m月d日", strtotime($project->ended_at)) }}</span></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="task-container">
            <div class="task-container__item">
                <h2 class="task-container__item__wrap__title">タスク</h2>
                <ul class="task-container__item__list">
                    <li>プロジェクト</li>
                    <li>タスク</li>
                    <li>パートナー</li>
                    <li>ステータス</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="task-container__content">
                @if ($tasks->count() === 0)
                    <p class="non-task-text">{{ Auth::user()->name }}様がアサインされているタスクはありません。</p>
                @endif
                @foreach ($tasks as $task)
                    <a class="task-show-link" href="/partner/task/{{ $task->id }}">
                        <ul class="task-item-list task-container__content__list">
                            <li class="task-name">{{ $task->project->name }}</li>
                            <li>{{ $task->name }}</li>
                            <li class="partner-item">
                                <div class="imgbox"><img src="{{ $task->partner->picture }}" alt=""></div>
                                <p class="name">{{ $task->partner->name }}</p>
                            </li>
                            @if($task->status === config('const.TASK_CREATE'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">下書き</div>
                                </li>
                            @elseif($task->status === config('const.TASK_SUBMIT_SUPERIOR'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスク上長確認中</div>
                                </li>
                            @elseif($task->status === config('const.TASK_APPROVAL_SUPERIOR'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスクパートナー依頼前</div>
                                </li>
                            @elseif($task->status === config('const.TASK_SUBMIT_PARTNER'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">タスクパートナー確認中</div>
                                </li>
                            @elseif($task->status === config('const.TASK_APPROVAL_PARTNER'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書作成前</div>
                                </li>
                            @elseif($task->status === config('const.ORDER_SUBMIT_SUPERIOR'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書上長確認中</div>
                                </li>
                            @elseif($task->status === config('const.ORDER_APPROVAL_SUPERIOR'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書パートナー確認前</div>
                                </li>
                            @elseif($task->status === config('const.ORDER_SUBMIT_PARTNER'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">発注書パートナー確認中</div>
                                </li>
                            @elseif($task->status === config('const.ORDER_APPROVAL_PARTNER'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">作業前</div>
                                </li>
                            @elseif($task->status === config('const.WORKING'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">作業中</div>
                                </li>
                            @elseif($task->status === config('const.DELIVERY_PARTNER'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">検品中</div>
                                </li>
                            @elseif($task->status === config('const.ACCEPTANCE'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書作成前</div>
                                </li>
                            @elseif($task->status === config('const.INVOICE_DRAFT_CREATE'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書下書き</div>
                                </li>
                            @elseif($task->status === config('const.INVOICE_CREATE'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書担当者確認前</div>
                                </li>
                            @elseif($task->status === config('const.SUBMIT_STAFF'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書担当者確認中</div>
                                </li>
                            @elseif($task->status === config('const.SUBMIT_ACCOUNTING'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書経理提出</div>
                                </li>
                            @elseif($task->status === config('const.APPROVAL_ACCOUNTING'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">請求書経理承認済み</div>
                                </li>
                            @elseif($task->status === config('const.COMPLETE_STAFF'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn done">完了</div>
                                </li>
                            @elseif($task->status === config('const.TASK_CANCELED'))
                                <li class="task-container__content__list__status">
                                    <div class="s-btn">キャンセル</div>
                                </li>
                            @endif 
                            <li>¥{{ number_format($task->price) }}</li>
                        </ul>
                    </a> 
                @endforeach
            </div>

            <div class="task-container__content__showmore">
                <p id="showmore_task_btn" class="task-container__content__showmore__btn">もっと見る</p>
            </div>
        </div>
    </div>
</div>
@endsection
