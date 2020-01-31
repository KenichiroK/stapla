<div class="todo-container">
    <div class="table-title-container">
        <h4 class="table-title-container__text">あなたのTODO<span class="table-title-container__num">{{ count($todos) }}件</span></h4>
        <p class="table-title-container__alert">
            3日以上未対応
            <button id="toggle_todo_btn" class="table-title-container__alert--button" type="button">
                {{ count($passed_3days_todos) }}<span class="title-container__alert--unit">件</span>
            </button>
        </p>
    </div>

    <div class="content-container">
        <div class="content-container__head">
            <p class="content-container__head--long">プロジェクト</p>
            <p class="content-container__head--long">タスク</p>
            <p class="content-container__head--long">パートナー</p>
            <p class="content-container__head--long">依頼日時</p>
            <p class="content-container__head--short"></p>
        </div>

        <div id="all_todos">

            @if (count($todos) === 0)
            <p class="no-data">あなたのtodoはありません</p>
            @endif

            @foreach($todos as $todo)
            <div class="content-container__body all_todo_item">
                <a class="content-container__body--link" href="{{ route('company.task.show', ['id' => $todo->id]) }}">
                    <p class="content-container__body--long">{{ $todo->project->name }}</p>
                    <p class="content-container__body--long">{{ $todo->name }}</p>
                    <p class="content-container__body--long">
                            <img class="profile-img" src="{{ $todo->partner->picture }}" alt="">
                            <span>{{ $todo->partner->name }}</span>
                    </p>
                    <p class="content-container__body--long">
                        {{ date('n月j日', strtotime($todo->status_updated_at)) }}
                        @if (\Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($todo->status_updated_at)) > 3)
                            <br>
                            <span class="date-alert">依頼から{{ \Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($todo->status_updated_at)) }}日経っています</span>
                        @endif
                    </p>
                    <p class="content-container__body--short">
                        <span class="button">対応する</span>
                    </p>
                </a>
            </div>
            @endforeach
            <div id="all_todo_more_btn_area" class="morebtn-container">
                <p id="all_todo_more_btn" class="morebtn-container__text">もっと見る</p>
            </div>
        </div>

        <div id="passed_3days_todos">
            @if (count($passed_3days_todos) === 0)
                <p class="no-data">3日以上未対応のtodoはありません</p>
            @endif

            @foreach($passed_3days_todos as $todo)
            <div class="content-container__body passed_3days_todo_item">
                <a class="content-container__body--link" href="{{ route('company.task.show', ['id' => $todo->id]) }}">
                    <p class="content-container__body--long">{{ $todo->project->name }}</p>
                    <p class="content-container__body--long">{{ $todo->name }}</p>
                    <p class="content-container__body--long">
                            <img class="profile-img" src="{{ $todo->partner->picture }}" alt="">
                            <span>{{ $todo->partner->name }}</span>
                    </p>
                    <p class="content-container__body--long">
                        {{ date('n月j日', strtotime($todo->status_updated_at)) }}
                        @if (\Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($todo->status_updated_at)) > 3)
                            <br>
                            <span class="date-alert">依頼から{{ \Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($todo->status_updated_at)) }}日経っています</span>
                        @endif
                    </p>
                    <p class="content-container__body--short">
                        <span class="button">対応する</span>
                    </p>
                </a>
            </div>
            @endforeach

             <div id="passed_3days_todo_more_btn_area" class="morebtn-container">
                <p id="passed_3days_todo_more_btn" class="morebtn-container__text">もっと見る</p>
            </div>
        </div>
    </div>
</div>
