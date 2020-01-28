<div class="project-container">
    <div class="table-title-container">
        <h4 class="table-title-container__text">
            {{ config('consts.project.STATUS_NAME')[$project_status] }}のプロジェクト<span class="table-title-container__num">{{ $projects->count() }}件</span>
        </h4>
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
        <p class="no-data">
            {{ config('consts.project.STATUS_NAME')[$project_status] }}のプロジェクトはありません
        </p>
        @endif

        @foreach($projects as $project)
        <div class="content-container__body project_item">
            <a class="content-container__body--link" href="{{ route('company.project.show', ['id' => $project->id]) }}">
                <p class="content-container__body--long">{{ $project->name }}</p>
                <p class="content-container__body--short">
                    <img class="profile-img" src="{{ $project->projectCompanies[0]->companyUser->picture }}" alt="">
                     @if ($project->projectCompanies->count() > 1) 
                    <span>
                        {{ $project->projectCompanies[0]->companyUser->name }}
                        他{{ $project->projectCompanies->count() - 1 }}名
                    </span>
                    @else
                    <span>{{ $project->projectCompanies[0]->companyUser->name }}</span>
                    @endif
                </p>
                <p class="content-container__body--short">{{ $project->tasks->count() }}件</p>
                <p class="content-container__body--short">{{ date('n月j日', strtotime($project->ended_at)) }}</p>
                <p class="content-container__body--short">¥ {{ number_format($project->budget) }}</p>
                <p class="content-container__body--short">¥ {{ number_format($project->price) }}</p>
            </a>
        </div>
        @endforeach

         <div id="project_more_btn_area" class="morebtn-container">
            <p id="project_more_btn" class="morebtn-container__text">もっと見る</p>
        </div>
    </div>
</div>
