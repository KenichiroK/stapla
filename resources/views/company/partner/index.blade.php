@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        @if(session('completed'))
            <div class="complete-container">
                <p>{{ session('completed') }}</p>
            </div>
        @endif

        <div class="top-container">
            <h1 class="top-container__title">パートナー</h1>
            <div class="btn-a-container">
                <a href="{{ route('company.invite.partner') }}">パートナー追加</a>
            </div>
        </div>

        <div class="profile-list">

            @foreach( $partners as $partner )
            <div class="profile-card-container">
                <div class="profile-card-container__wrapper">
                    <div class="main-content">
                        <div class="main-content__img-container">
                            <img src="{{ $partner->picture }}"  alt="">
                        </div>
                        <div class="main-content__info-list">
                            <div class="main-content__info-list__name">{{ $partner->name }}</div>
                            <div class="main-content__info-list__job">{{ $partner->occupations }}</div>
                            <div class="main-content__info-list__assessment-achievement"></div>
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
