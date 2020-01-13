<div class="task-container">
    <div class="title-container">
        <h4 class="title-container__text">あなたのアサインされたタスク<span class="title-container__num">{{ $tasks->count() }}件</span></h4>
    </div>

    <div class="content-container">
        <div class="content-container__head">
                <p class="content-container__head--long">プロジェクト</p>
                <p class="content-container__head--long">タスク</p>
                <p class="content-container__head--long">担当者</p>
                <p class="content-container__head--long">ステータス</p>
                <p class="content-container__head--long">請求額</p>
        </div>

        @if (count($tasks) === 0)
        <p class="no-data">あなたのアサインされたタスクはありません</p>
        @endif

        @foreach($tasks as $task)
        <div class="content-container__body task_item">
            <a class="content-container__body--link" href="{{ route('partner.task.show', ['id' => $task->id]) }}">
                <p class="content-container__body--long">{{ $task->project->name }}</p>
                <p class="content-container__body--long">{{ $task->name }}</p>
                <p class="content-container__body--long">
                    <img class="profile-img" src="{{ $task->companyUser->picture }}" alt="">
                    <span>{{ $task->companyUser->name }}</span>
                </p>
                <p class="content-container__body--long">{{ config('const.TASK_STATUS_LIST')[$task->status] }}</p>
                <p class="content-container__body--long">¥{{ number_format($task->price) }}</p>
            </a>
        </div>
        @endforeach

         <div id="task_more_btn_area" class="morebtn-container">
            <p id="task_more_btn" class="morebtn-container__text">もっと見る</p>
        </div>
    </div>
</div>
