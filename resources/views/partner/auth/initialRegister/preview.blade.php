@extends('index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/preview.css') }}">
@endsection

@section('content')
<header>
    <div class="logo_container">
        <p class="logo">impro</p>
    </div>
</header>

<main>
    <div class="main-wrapper">
        <div class="title-container">
            <h3>入力内容確認</h3>
        </div>

        <form action="{{ route('partner.register.preview.previewStore') }}" method="POST">
            @csrf
            <input type="hidden" name="">
            <div class="edit-container">

                <div class="company-container">
                    <div class="profile-container">
                        <div class="section-container">
                            <p>名前</p>
                            <input type="hidden" name="name" value="{{ old('name', $partner->name) }}">
                            <h4>{{ $partner->name }}</h4>
                        </div>

                        <div class="section-container">
                            <p>職種</p>
                            <input type="hidden" name="occupations" value="{{ old('occupations', $partner->occupations) }}">
                            <h4>{{ $partner->occupations }}</h4>
                        </div>

                        <div class="section-container">
                            <p>プロフィールメッセージ</p>
                            <input type="hidden" name="introduction" value="{{ old('introduction', $partner->introduction) }}">
                            <h4>{!! nl2br(e($partner->introduction)) !!}</h4>
                        </div>

                        <div class="section-container">
                            <p>郵便番号</p>
                            <input type="hidden" name="zip_code" value="{{ old('zip_code', $partner->zip_code) }}">
                            <h4>{{ $partner->zip_code }}</h4>
                        </div>

                        <div class="section-container">
                            <p>住所</p>
                            <input type="hidden" name="prefecture" value="{{ old('prefecture', $partner->prefecture) }}">
                            <input type="hidden" name="city" value="{{ old('city', $partner->city) }}">
                            <input type="hidden" name="street" value="{{ old('street', $partner->street) }}">
                            <input type="hidden" name="building" value="{{ old('building', $partner->building) }}">
                            <h4>
                                {{ $partner->prefecture }}
                                {{ $partner->city }}
                                {{ $partner->street }}
                                {{ $partner->building }}
                            </h4>
                        </div>

                        <div class="section-container">
                            <p>電話番号</p>
                            <input type="hidden" name="tel" value="{{ old('tel', $partner->tel) }}">
                            <h4>{{ $partner->tel }}</h4>
                        </div>

                        <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                    </div>
                </div>
            </div>
            <div class="btn-container">
            <a href="{{ route('partner.register.intialRegistration.createPartner', ['partner_id' => $partner->id ]) }}">入力し直す</a>
            <button data-impro-button="once" type="button" onclick="submit();">登録</button>
        </div>
        </form> 
    </div>
</main>
@endsection
