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

        <div class="partner-content">
            <h3 class="partner-content__title">ステータス</h3>

            {{-- TODO:　resources/views/partner/project/index.blade.phpのidがtab-buttonのやつをパクる --}}
            <ul class="partner-content__tab">
                <li class="is-active">
                    <a class="tab-btn" href="">全て<span class="counter">(20)</span></a>
                </li>
                <li>
                    <a class="tab-btn" href="">契約締結済<span class="counter">(5)</span></a>
                </li>
                <li>
                    <a class="tab-btn" href="">契約作業中<span class="counter">(10)</span></a>
                </li>
                <li>
                    <a class="tab-btn" href="">未契約<span class="counter">(5)</span></a>
                </li>
            </ul>

            <div class="partner-content__card-wrapper">
                <div class="card">
                    <div class="card__content"></div>
                    <div class="card__footer"></div>
                </div>
            </div>
        </div>

        <div class="temp" style="margin-bottom:100px;"></div>


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
                    {{ $partners->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
