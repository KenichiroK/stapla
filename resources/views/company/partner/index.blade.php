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
                    <img src="{{ asset('images/searchicon.png') }}" alt="serch">
                    </span>
                </p> -->
                <div class="btn-a-container">
                    <a href="{{ route('company.partner.invite.partner.index') }}">パートナー追加</a>
                </div>
        </div>
        
        <div class="profile-list">
            
            @foreach( $partners as $partner )
            
            <div class="profile-card-container">
                <!-- <a href="/company/partner/{{ $partner->id }}"> -->
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
                                    <a href="{{ route('company.partner.show', ['id' => $partner->id]) }}"><img src="{{ asset('images/edit.png') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="icon-list-wrp">
                            <div class="icon-list">
                                <div><a class="default-color github"><img src="{{ asset('images/github.png') }}" alt=""></a></div>
                                <div><a class="default-color twitter"><img src="{{ asset('images/twitter.png') }}" alt=""></a></div>
                                <div><a class="default-color facebook"><img src="{{ asset('images/facebook.png') }}" alt=""></a></div>
                                <div><a class="default-color instagram"><img src="{{ asset('images/insta.png') }}" alt=""></a></div>
                                <div><a class="default-color mail"><img src="{{ asset('images/mail.png') }}" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                <!-- </a> -->
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
