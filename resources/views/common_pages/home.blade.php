@extends('index')

@section('assets')
<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .signup-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .partner {
        background-color: pink;
        height: 140px;
        line-height:140px;
        text-align: center;
        width: 280px;
        margin: 100px 40px;
    }

    .company {
        background-color: skyblue;
        height: 140px;
        line-height:140px;
        text-align: center;
        width: 280px;
        margin: 100px 40px;
    }
    </style>
@endsection

@section('content')
<div class="login-wrapper">
    <div class="partner">
        <a href="{{ route('partner.login') }}">パートナーの方用 ログイン画面</a>
    </div>

    <div class="company">
        <a href="{{ route('company.login') }}">企業の方用 ログイン画面</a>
    </div>
</div>

<div class="signup-wrapper">
    <a href="{{ route('company.PreRegister') }}">新規登録はこちら</a>
</div>
@endsection
