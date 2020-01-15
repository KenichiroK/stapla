 <div class="task-container">
     <div class="table-title-container">
        <p class="table-title-container__text">タスク<span class="table-title-container__num">{{ $tasks->count() }}件</span></p>
     </div>

    <div class="content-container">
        <div class="content-container__head">
            <p class="content-container__head--task-index">プロジェクト</p>
            <p class="content-container__head--task-index">タスク</p>
            <p class="content-container__head--task-index">担当者</p>
            <p class="content-container__head--task-index">パートナー</p>
            <p class="content-container__head--task-index">ステータス</p>
            <p class="content-container__head--task-index">請求額</p>
        </div>

        @if (count($tasks) === 0)
        <p class="no-data">あなたのアサインされたタスクはありません</p>
        @endif

        @foreach($tasks as $task)
        <div class="content-container__body task_item">
            @if($task->status === config('const.TASK_CREATE'))
                <a class="content-container__body--link" href="{{ route('company.task.createDraft', ['id' => $task->id]) }}">
            @else
                <a class="content-container__body--link" href="{{ route('company.task.show', ['id' => $task->id]) }}">
            @endif
                <p class="content-container__body--task-index">{{ $task->project->name }}</p>
                <p class="content-container__body--task-index">{{ $task->name }}</p>
                <p class="content-container__body--task-index">
                    @isset($task->company_user_id)
                        <img class="profile-img" src="{{ $task->companyUser->picture }}" alt="">
                        <span>{{ $task->companyUser->name }}</span>
                    @endisset
                </p>
                <p class="content-container__body--task-index">
                    @isset($task->partner_id)
                        <img class="profile-img" src="{{ $task->partner->picture }}" alt="">
                        <span>{{ $task->partner->name }}</span>
                    @endisset
                </p>
                <p class="content-container__body--task-index">{{ config('const.TASK_STATUS_LIST')[$task->status] }}</p>
                <p class="content-container__body--task-index">¥{{ number_format($task->price) }}</p>
            </a>
        </div>
        @endforeach

         <div id="task_more_btn_area" class="morebtn-container">
            <p id="task_more_btn" class="morebtn-container__text">もっと見る</p>
        </div>
    </div>
</div>
