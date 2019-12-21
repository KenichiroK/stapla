<div class="project-container">
    <div class="title-container">
        <h4 class="title-container__text">あなたのプロジェクト<span class="title-container__num">{{ $projects->count() }}件</span></h4>
    </div>

    <div class="content-container">
        <div class="content-container__head">
            <p class="content-container__head--long">プロジェクト</p>
            <p class="content-container__head--short">担当者</p>
            <p class="content-container__head--short">タスク</p>
            <p class="content-container__head--short">期限</p>
            <p class="content-container__head--short">予算</p>
            <p class="content-container__head--short">請求額</p>
        </div>

        @if (count($projects) === 0)
        <p class="no-data">あなたのプロジェクトはありません</p>
        @endif

        @foreach($projects as $project)
        <div class="content-container__body project_item">
            <a class="content-container__body--link" href="{{ route('company.project.show', ['id' => $project->id]) }}">
                <p class="content-container__body--long">{{ $project->name }}</p>
                <p class="content-container__body--short">
                    <img class="profile-img" src="{{ $project->companyUser->picture }}" alt="">
                    <span>{{ $project->companyUser->name }}</span>
                </p>
                <p class="content-container__body--short">{{ $project->project->tasks->count() }}件</p>
                <p class="content-container__body--short">{{ date('n月j日', strtotime($project->ended_at)) }}</p>
                <p class="content-container__body--short">¥{{ number_format($project->budget) }}</p>
                <p class="content-container__body--short">¥{{ number_format($project->price) }}</p>
            </a>
        </div>
        @endforeach

         <div id="project_more_btn_area" class="morebtn-container is-active">
            <p id="project_more_btn" class="morebtn-container__text">もっと見る</p>
        </div>
    </div>
</div>
