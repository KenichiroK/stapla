@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/show.css') }}">
@endsection

@section('content')

<div class="main__container">
    <!-- アクティビティログメニュー -->
    <!-- <div class="activity-log-menu">
        <div class="activity-log-menu__top">
            <div class="activity-log-menu__top__title">アクティビティログ</div>
            <div id="close-btn" class="close-container"><span class="close-container__btn">閉じる</span><i class="fas fa-long-arrow-alt-right"></i></div>
        </div>
        <div class="notification-wrp">
            <div class="notification-container">
                <div class="notification-container__img-container">
                    <img src="{{ env('AWS_URL') }}/common/photoimg.png" alt="">
                </div>
                <div class="notification-container__content">
                    <p class="notification-container__content__name">永瀬達也</p>
                    <p class="notification-container__content__done">@@@@を作成しました。</p>
                    <p class="notification-container__content__date">2019年1月1日 00:00</p>
                </div>
            </div>
        </div>
        <div class="notification-wrp">
            <div class="notification-container">
                <div class="notification-container__img-container">
                    <img src="{{ env('AWS_URL') }}/common/photoimg.png" alt="">
                </div>
                <div class="notification-container__content">
                    <p class="notification-container__content__name">永瀬達也</p>
                    <p class="notification-container__content__done">@@@@を作成しました。</p>
                    <p class="notification-container__content__date">2019年1月1日 00:00</p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="main__container__wrapper">
        <div>
            @if (session('completed'))
                <div class="complete-container">
                    <p>{{ session('completed') }}</p>
                </div>
            @endif
            <div class="top-container">
                <h1 class="top-container__title">{{ $project->name }}詳細</h1>
                <!-- <a class="top-container__edit-btn" href="#"><div>編集</div></a> -->
            </div>

            <!-- <div class="activity-log-container">
                <div class="activity-log-container__left">
                    <div class="activity-log-container__left__name-container">
                        <div class="img-container"><img src="{{ env('AWS_URL') }}/common/photoimg.png" alt=""></div>
                        <p class="name">永瀬達也</p>
                    </div>
                    <div class="activity-log-container__left__content">
                        <p>@@@@を作成しました。</p>
                        <p>2019年1月1日 00:00</p>
                    </div>
                </div>
                <div class="activity-log-container__right">
                    <div id="activity-display-btn" class="activity-log-container__right__btn-container">
                        <i class="fa fa-list-ul"></i><span class="activity-log-container__right__btn-container__btn">アクティビティログ</span>
                    </div>
                </div>
            </div> -->

            <div class="detail-container">
                <ul class="detail-container__list">
                    <li class="detail-container__list__item margin--none"><div class="detail-container__list__item__name">プロジェクト名</div> <p class="detail-container__list__item__content">{{ $project->name }}</p> </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">プロジェクト詳細</div><p class="detail-container__list__item__content desc-item">{!! nl2br(e($project->detail)) !!}</p></li>
                    <li class="detail-container__list__item al-center"><div class="detail-container__list__item__name">担当者</div>
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
                                <div class="period__wrapper__container__start">開始日<span class="period__wrapper__container__start__date">{{ date("Y年m月d日", strtotime($project->started_at)) }}</span></div>
                                <div class="period__wrapper__container__end">終了日<span class="period__wrapper__container__end__date">{{ $project->ended_at->format('Y年m月d日') }}</span></div>
                            </div>
                        </div>
                    </li>
                    <li class="detail-container__list__item"><div class="detail-container__list__item__name">予算</div><div class="detail-container__list__item__content">{{ number_format($project->budget) }}円</div></li>
                    <!-- <li class="detail-container__list__item border-none al-center"><div class="detail-container__list__item__name">資料</div>
                        <div class="detail-container__list__item__content file-item">
                            <div class="imgbox"><img src="{{ env('AWS_URL') }}/common/file.png" alt=""></div>
                            <p>ファイル名</p>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>

        <div class="task-container">
            <div class="task-container__item">
                <div class="task-container__item__wrap">
                    <h2 class="task-title">タスク</h2>
                    <div class="btn-a-container">
                        <a href="{{ route('company.task.create') }}">タスク作成</a>
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
                <a class="task-show-link" href="{{ route('company.task.show', ['id' => $task->id]) }}">
                    <ul class="task-item-list task-container__content__list">
                        <li class="task-name">{{ $task->project->name }}</li>
                        <li>{{ $task->name }}</li>
                        <li class="partner-item">
                            <div class="imgbox"><img src="{{ $task->partner->picture }}" alt=""></div>
                            <p class="name">
                                {{ $task->partner->name }}</p>
                        </li>
                        @if($task->status === 0)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">下書き</div>
                        </li>
                        @elseif($task->status === 1)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">タスク上長確認前</div>
                        </li>
                        @elseif($task->status === 2)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">タスク上長確認中</div>
                        </li>
                        @elseif($task->status === 3)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">タスクパートナー依頼前</div>
                        </li>
                        @elseif($task->status === 4)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">タスクパートナー依頼中</div>
                        </li>
                        @elseif($task->status === 5)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">発注書作成中</div>
                        </li>
                        @elseif($task->status === 6)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">発注書作成完了</div>
                        </li>
                        @elseif($task->status === 7)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">発注書上長確認中</div>
                        </li>
                        @elseif($task->status === 8)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">発注書パートナー依頼前</div>
                        </li>
                        @elseif($task->status === 9)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">発注書パートナー確認中</div>
                        </li>
                        @elseif($task->status === 10)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">作業中</div>
                        </li>
                        @elseif($task->status === 11)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">請求書依頼中</div>
                        </li>
                        @elseif($task->status === 12)
                        <li class="task-container__content__list__status">
                            <div class="s-btn">請求書確認中</div>
                        </li>
                        @elseif($task->status === 13)
                        <li class="task-container__content__list__status">
                            <div class="s-btn done">完了</div>
                        </li>
                        @elseif($task->status === 14)
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

        @if($projectCompany->companyUser->id === Auth::id())
            <form onsubmit="return checkStatus()" action="{{ route('company.project.complete', ['id' => $project->id, 'status' => $project->status]) }}" name="form1" method='POST' enctype="multipart/form-data">
                @csrf

                @foreach($tasks as $task)
                    <input type="hidden" name="taskStatus[]" value="{{ $task->status }}">
                @endforeach

                <div class="button-container">
                    <!-- <div class="preview-button-wrapper">
                        <button type="submit" class="preview-button-wrapper__btn button">プレビュー</button>
                    </div> -->

                    @if($project->status == config('const.PROJECT_CREATE'))
                        <div class="btn01-container">
                            <button type="submit">完了</button>
                            <input type="hidden" name="projectStatus" value="{{ $project->status }}">
                        </div>
                    @elseif($project->status == config('const.PROJECT_COMPLETE'))
                        <div class="btn01-container">
                            <button type="submit">再オープン</button>
                            <input type="hidden" name="projectStatus" value="{{ $project->status }}">
                        </div>
                    @endif
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
