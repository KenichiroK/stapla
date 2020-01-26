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
            <div class="edit-container">
                <div class="company-container">
                    <div class="section-container">
                        <p class="profile-subject">名前</p>
                        <p>{{ $partner->name }}</p>
                        <input type="hidden" name="name" value="{{ $partner->name }}">
                    </div>

                    <div class="section-container">
                        <p class="profile-subject">職種</p>
                        <p>{{ $partner->occupations }}</p>
                        <input type="hidden" name="occupations" value="{{ $partner->occupations }}">
                    </div>

                    <div class="section-container">
                        <p class="profile-subject">プロフィールメッセージ</p>
                        <p>{{ $partner->introduction }}</p>
                        <input type="hidden" name="introduction" value="{{ $partner->introduction }}">
                    </div>

                    <div class="section-container">
                        <p class="profile-subject">郵便番号</p>
                        <p>{{ $partner->zip_code }}</p>
                        <input type="hidden" name="zip_code" value="{{ $partner->zip_code }}">
                    </div>

                    <div class="section-container">
                        <p class="profile-subject">住所</p>
                        <p>
                            {{ $partner->prefecture }}
                            {{ $partner->city }}
                            {{ $partner->street }}
                            {{ $partner->building }}
                        </p>

                        <input type="hidden" name="prefecture" value="{{ $partner->prefecture }}">
                        <input type="hidden" name="city" value="{{ $partner->city }}">
                        <input type="hidden" name="street" value="{{ $partner->street }}">
                        <input type="hidden" name="building" value="{{ $partner->building }}">
                    </div>

                    <div class="section-container">
                        <p class="profile-subject">電話番号</p>
                        <p>{{ $partner->tel }}</p>
                        <input type="hidden" name="tel" value="{{ $partner->tel }}">
                    </div>

                    <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                </div>
            </div>
            <div class="btn-container">
            <a href="{{ route('partner.register.personal.create', ['partner_id' => $partner->id ]) }}">入力し直す</a>
            <button class="button" data-impro-button="once" type="submit" onclick="submit();">登録</button>
        </div>
        </form> 
    </div>
</main>
@endsection
