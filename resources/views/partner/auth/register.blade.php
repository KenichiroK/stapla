@extends('index')

@section('assets')
<link href="{{ mix('css/auth/login/index.css') }}" rel="stylesheet">
<style>
    body: {
        margin: 0;
        padding: 0;
    }
</style>
@endsection

@section('content')
<header>
    <div class="logo_container">
        <div class="imgbox">
            <img src="{{ asset('images/logo2.png') }}" alt="logo">
        </div>
    </div>
</header>

<main>
    <div class="main_container">
        <div class="title_wrapper">
            <h1 class="text">パスワードを設定してください。</h1>
        </div>

        <div class="form_wrapper">
            <form method="POST" action="{{ route('partner.passwordRegister') }}">
                @csrf
                <div class="input_wrapper">
                    <input class="input_text" type="hidden" name="email" value="{{ $request->email }}">
                    @if($errors->has('email'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input_wrapper">
                    <h4 class="title">
                        パスワード
                        <span class="required-label row-label">( 必須 )</span>
                    </h4>
                    <input class="input_text" type="password" name="password">
                        @if ($errors->has('password'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input_wrapper">
                    <h4 class="title">
                        パスワード確認
                        <span class="required-label row-label">( 必須 )</span>
                    </h4>
                    <input class="input_text" type="password" name="password_confirmation">
                </div>

                <div class="input_wrapper">
                    <input class="input_text" type="hidden" name="company_id" value="{{ $request->company_id }}">
                    @if($errors->has('company_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('company_id') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- HACK: company_idもバリデーションかけてなかったけどもユーザがURLのパラメータ直接編集してくるの考慮しなくてもいいですかね --}}
                <div class="input_wrapper">
                    <input class="input_text" type="hidden" name="invitation_user_id" value="{{ $request->invitation_user_id }}">
                    @if($errors->has('invitation_user_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('invitation_user_id') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="button_wrapper">
                    <button class="button" data-impro-button="once" type="button" onclick="submit();">新規会員登録</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
