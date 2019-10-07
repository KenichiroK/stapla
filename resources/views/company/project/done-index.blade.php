@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div class="top-container">
            <h1 class="top-container__title">プロジェクト</h1>
            <div>
                <p class="control has-icons-left serch-wrp">
                    <!-- <input class="search-project input" type="text" placeholder="プロジェクトを検索">
                    <span class="">
                    <img src="{{ asset('images/searchicon.png') }}" alt="serch">
                    </span> -->
                </p>
            </div>
            <div class="control btn-a-container">
                <a href="project/create">プロジェクト作成</a>
            </div>
        </div>

        <ul id="tab-button" class="tab-button">
            <li class="all"><a href="{{ route('company.project.index') }}">プロジェクト</a></li>
            <li class="done isActive"><a href="{{ route('company.project.done.index') }}">完了したプロジェクト</a></li>
        </ul>

        <div class="project-container">
            <div class="project-container__item">
                <ul class="item_list">
                    <li>プロジェクト
                        <span><i class="arrow fas fa-angle-up"></i><i class="arrow fas fa-angle-down"></i></span>
                    </li>
                    <li>担当者</li>
                    <li>パートナー</li>
                    <li>タスク</li>
                    <li>期限</li>
                    <li>予算</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="project-container__content">
                @foreach( $projects as $project )
                <a class="show-link" href="{{ route('company.project.show', ['id' => $project->id]) }}">
                    <ul class="content_list" >
                        <li class="item-list project-name">{{ $project->name }}</li>
                        <li>
                            <div class="photoimgbox">
                                <img src="/{{ str_replace('public/', 'storage/', $project->projectCompanies[0]->companyUser->picture) }}" alt="担当者プロフィール画像">
                            </div>
                            @if ($project->projectCompanies->count() > 1) 
                                <p>
                                    {{ $project->projectCompanies[0]->companyUser->name }}
                                    他{{ $project->projectCompanies->count() - 1 }}名
                                </p>
                            @else
                                <p>{{ $project->projectCompanies[0]->companyUser->name }}</p>
                            @endif 
                        </li>
                        <li>
                            <div class="photoimgbox">
                                <img src="/{{ str_replace('public/', 'storage/', $project->projectPartners[0]->partner->picture) }}" alt="担当者プロフィール画像">
                            </div>
                            @if ($project->projectPartners->count() > 1) 
                                <p>
                                    {{ $project->projectPartners[0]->partner->name }}
                                    他{{ $project->projectPartners->count() - 1 }}名
                                </p>
                            @else
                                <p>{{ $project->projectPartners[0]->partner->name }}</p>
                            @endif 
                        </li>
                        <li>
                            <span class="txt-underline">{{ $task_count_arr[$loop->index] }}</span>件
                        </li>
                        <li>{{ date("Y年m月d日", strtotime($project->ended_at)) }}</li>
                        <li>¥{{ number_format($project->budget) }}</li>
                        <li>¥{{ number_format($project->price) }}</li>
                    </ul>
                </a>
                @endforeach
            </div>

            <div class="showmore-wrp">
                <p id="showmore_btn" class="showmore__btn"><a>もっと見る</a>
                    <span><img src="{{ asset('images/arrowdown.png') }}"></span>
                </p>
            </div>
        </div> 
    </div>
</div>
@endsection
