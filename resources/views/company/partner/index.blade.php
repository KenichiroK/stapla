@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        @if (session('send_success'))
        <div class="complete-container">
            <p>{{ session('send_success') }}</p>
        </div>
        @endif

        <div class="top-container">
            <h1 class="top-container__title">パートナー</h1>
                <!-- <p class="control has-icons-left serch-wrp">
                    <input class="search-name input" type="text" placeholder="パートナーを検索">
                    <span class="icon">
                    <img src="{{ env('AWS_URL') }}/common/searchicon.png" alt="serch">
                    </span>
                </p> -->
                <div class="btn-a-container">
                    <a href="{{ route('company.partner.invite.partner.index') }}">パートナー追加</a>
                </div>
        </div>
        
        <div class="profile-list">
            
            @foreach( $partners as $partner )
            
            <div class="profile-card-container">
                <div class="profile-card-container__wrapper">
                    <div class="main-content">
                        <div class="main-content__img-container">
                            <!-- <img class="main-content__img-container__img" src="" alt=""> -->
                            <img src="{{ $partner->picture }}"  alt="">
                        </div>
                        <div class="main-content__info-list">
                            <div class="main-content__info-list__name">{{ $partner->name }}</div>
                            <div class="main-content__info-list__job">{{ $partner->occupations }}</div>
                            <div class="main-content__info-list__assessment-achievement">
                                <!-- <div class="assessment">⭐⭐⭐⭐</div> -->
                                <!-- <div class="achievement">実績<span class="num">1</span><span class="ken">件</span></div> -->
                            
                            </div>
                            
                        </div>
                        <div class="main-content__edit-icons">
                            <div>
                                <img src="{{ env('AWS_URL') }}/common/edit.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
            
            <div class="pagenate-container">
                <div class="pagenate-container__wrapper">
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
