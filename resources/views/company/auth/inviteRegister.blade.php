@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/invite/partner/create.css') }}">
@endsection

@section('content')
<div class="form_wrapper">
    <!-- <form method="POST" action="{{ route('company.invite.company-user.register') }}"> -->
    <form method="POST" action="{{ route('company.invite.company-user.register') }}">
        @csrf
        <div class='input-container'>
			<p>メールアドレス</p>
            <input class="input_text" type="email" name="email" placeholder="impro@example.com">
            @if($errors->has('email'))
                <div class="invalid-feedback error-msg" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
		</div>

        <div class='input-container'>
			<p>パスワード</p>
            <input class="input_text" type="password" name="password">
            @if($errors->has('password'))
                <div class="invalid-feedback error-msg" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
		</div>

        <div class='input-container'>
			<p>パスワード確認</p>
            <input class="input_text" type="password" name="password_confirmation">
		</div>

        <div class='input-container'>
			<p>company_id</p>
            <input class="input_text" type="texet" name="company_id" value="{{ $company_user->company_id }}">
		</div>

        <div class="button_wrapper">
            <button type="button" onclick="submit();" class="text">新規会員登録</button>
        </div>
    </form>
</div>
@endsection