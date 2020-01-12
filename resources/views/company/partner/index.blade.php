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
            <h1 class="top-container__title">パートナ</h1>
            <div class="btn-a-container">
                <a href="{{ route('company.invite.partner') }}">パートナー追加</a>
            </div>
        </div>

        <div class="partner-content">
            <h3 class="partner-content__title">ステータス</h3>

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

                {{-- TODO: ダミーデータの要素は削除 --}}
                <div class="card">
                    <div class="card__content">
                        <div class="image-wrapper">
                            <img class="profile-image" src="https://avatars2.githubusercontent.com/u/30946750?s=460&v=4" alt="logo">
                        </div>
                        <div class="name-wrapper">
                            <p class="name">羽田 陽太</p>
                            <p class="occupations">エンジニア</p>
                        </div>
                    </div>
                    <div class="card__footer">
                        <div class="circle complete-color"></div>
                        <p class="status">契約締結済</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card__content">
                        <div class="image"></div>

                    </div>
                    <div class="card__footer">
                        <div class="circle uncontracted-color"></div>
                        <p class="status">未契約</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card__content">
                        <div class="image"></div>

                    </div>
                    <div class="card__footer">
                        <div class="circle progress-color"></div>
                        <p class="status">契約作業中</p>
                    </div>
                </div>

                @foreach( $partners as $partner )
                <div class="card">
                    <div class="card__content">
                        <div class="image-wrapper">
                            @if (isset($partner->picture))
                            <img class="profile-image" src="{{ $partner->picture }}">
                            @else
                            <img class="profile-image" src="{{ env('AWS_URL').'/common/dummy_profile_icon.png' }}">
                            @endif
                        </div>
                        <div class="name-wrapper">
                            <p class="name">{{ $partner->name }}</p>
                            <p class="occupations">{{ $partner->occupations }}</p>
                        </div>
                    </div>
                    <div class="card__footer">
                        <div class="circle complete-color"></div>
                        <p class="status">契約締結済</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagenate-container">
                <div class="pagenate-container__wrapper">
                    {{ $partners->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
