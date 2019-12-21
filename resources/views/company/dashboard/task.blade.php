 <div class="task-container">
    <div class="title-container">
        <h4 class="title-container__text">あなたのアサインされたタスク<span class="title-container__num">{{ $tasks->count() }}件</span></h4>
    </div>

    <div class="content-container">
        <div class="content-container__head">
                <p class="content-container__head--short">
                    <img src="{{ Auth::user()->picture }}" alt="profile icon">
                </p>
                <p class="content-container__head--long">プロジェクト</p>
                <p class="content-container__head--long">タスク</p>
                <p class="content-container__head--long">パートナー</p>
                <p class="content-container__head--long">ステータス</p>
                <p class="content-container__head--long">請求額</p>
        </div>

        @if (count($tasks) === 0)
        <p class="no-data">あなたのアサインされたタスクはありません</p>
        @endif

        @foreach($tasks as $task)
        <div class="content-container__body task_item">
            <a class="content-container__body--link" href="{{ route('company.task.show', ['id' => $task->id]) }}">
                <p class="content-container__body--short">
                    @if ($task->company_user_id === Auth::user()->id)
                        担当者<br>
                    @endif
                    @if ($task->superior_id === Auth::user()->id)
                        上長<br>
                    @endif
                    @if ($task->accounting_id === Auth::user()->id)
                        経理
                    @endif
                </p>
                <p class="content-container__body--long">{{ $task->project->name }}</p>
                <p class="content-container__body--long">{{ $task->name }}</p>
                <p class="content-container__body--long">
                    <img class="profile-img" src="{{ $task->partner->picture }}" alt="">
                    <span>{{ $task->partner->name }}</span>
                </p>
                <p class="content-container__body--long">{{ config('const.TASK_STATUS_LIST')[$task->status] }}</p>
                <p class="content-container__body--long">¥{{ number_format($task->price) }}</p>
            </a>
        </div>
        @endforeach

         <div id="task_more_btn_area" class="morebtn-container is-active">
            <p id="task_more_btn" class="morebtn-container__text">もっと見る</p>
        </div>
    </div>
</div>
