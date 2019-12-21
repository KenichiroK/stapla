<div class="todo-container">
    <div class="title-container">
        <h4 class="title-container__text">あなたのTODO<span class="title-container__num">{{ count($todos) }}件</span></h4>
        <p class="title-container__alert">
            3日以上未対応
            <button id="toggle_todo_btn" class="title-container__alert--button" type="button">
                {{ count($after_3_days_todos) }}<span class="title-container__alert--unit">件</span>
            </button>
        </p>
    </div>

    <div class="content-container">
        <div class="content-container__head">
            <p class="content-container__head--long">プロジェクト</p>
            <p class="content-container__head--long">タスク</p>
            <p class="content-container__head--long">パートナー</p>
            <p class="content-container__head--long">以来日時</p>
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
                        @if (Auth::user()->id === $todo->company_user_id)
                            <img class="profile-img" src="{{ $todo->companyUser->picture }}" alt="">
                            <span>{{ $todo->companyUser->name }}</span>
                        @elseif (Auth::user()->id === $todo->superior_id)
                            <img class="profile-img" src="{{ $todo->superior->picture }}" alt="">
                            <span>{{ $todo->superior->name }}</span>
                        @elseif (Auth::user()->id === $todo->accounting_id)
                            <img class="profile-img" src="{{ $todo->accounting->picture }}" alt="">
                            <span>{{ $todo->accounting->name }}</span>
                        @endif
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
            <div id="all_todo_more_btn_area" class="morebtn-container is-active">
                <p id="all_todo_more_btn" class="morebtn-container__text">もっと見る</p>
            </div>
        </div>

        <div id="after_three_days_todos">
            @if (count($after_3_days_todos) === 0)
                <p class="no-data">3日以上未対応のtodoはありません</p>
            @endif

            @foreach($after_3_days_todos as $todo)
            <div class="content-container__body after_three_days_todo_item">
                <a class="content-container__body--link" href="{{ route('company.task.show', ['id' => $todo->id]) }}">
                    <p class="content-container__body--long">{{ $todo->project->name }}</p>
                    <p class="content-container__body--long">{{ $todo->name }}</p>
                    <p class="content-container__body--long">
                        @if (Auth::user()->id === $todo->company_user_id)
                            <img class="profile-img" src="{{ $todo->companyUser->picture }}" alt="">
                            <span>{{ $todo->companyUser->name }}</span>
                        @elseif (Auth::user()->id === $todo->superior_id)
                            <img class="profile-img" src="{{ $todo->superior->picture }}" alt="">
                            <span>{{ $todo->superior->name }}</span>
                        @elseif (Auth::user()->id === $todo->accounting_id)
                            <img class="profile-img" src="{{ $todo->accounting->picture }}" alt="">
                            <span>{{ $todo->accounting->name }}</span>
                        @endif
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

             <div id="after_three_days_todo_more_btn_area" class="morebtn-container is-active">
                <p id="after_three_days_todo_more_btn" class="morebtn-container__text">もっと見る</p>
            </div>
        </div>
    </div>
</div>
