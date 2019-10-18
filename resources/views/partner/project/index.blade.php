@extends('partner.index')

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
                    <img src="{{ env('AWS_URL') }}/common/searchicon.png" alt="serch">
                    </span> -->
                </p>
            </div>
        </div>

        <ul id="tab-button" class="tab-button">
            <li class="all  isActive"><a href="">プロジェクト</a></li>
            <li class="done"><a href="">完了したプロジェクト</a></li>
        </ul>

        <div class="project-container">
            <div class="project-container__item">
                <ul class="item_list">
                    <li>プロジェクト</li>
                    <li>担当者</li>
                    <li>タスク</li>
                    <li>期限</li>
                    <li>予算</li>
                    <li>請求額</li>
                </ul>
            </div>

            <div class="project-container__content">
                
                <a class="show-link" href="">
                    <ul class="item-list content_list" >
                        <li class="item-list project-name">ライティング</li>
                        <li>
                            <div class="photoimgbox">
                                <img src="" alt="担当者プロフィール画像">
                            </div>
                                <p>宇野 裕樹</p>
                        </li>
                        <li>
                            <div class="photoimgbox">
                                <img src="" alt="担当者プロフィール画像">
                            </div>
                                <p>野村さゆり</p> 
                        </li>
                        <li>
                            <span class="txt-underline">3</span>件
                        </li>
                        <li>2019年09月30日</li>
                        <li>¥10,000</li>
                        <li>¥50,000</li>
                    </ul>
                </a>
                
            </div>

            <div class="showmore-wrp">
                <p id="showmore_btn" class="showmore__btn"><a>もっと見る</a>
                    <span><img src="{{ env('AWS_URL') }}/common/arrowdown.png"></span>
                </p>
            </div>
        </div> 
    </div>
</div>
@endsection
