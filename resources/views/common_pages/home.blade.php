@extends('index')

@section('assets')
<style>
    /* .login-wrapper {
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
    } */
    .user-wrapper {
        width: 400px;
        /* padding: 24px;  */
        margin: 40px;
        border: #454952 1px solid;

        text-align: center;
    }

    p {
        font-size: 24px;
        color: #454952;
    }

    .login-wrapper {
        margin: 24px auto;
    }
    </style>
@endsection

@section('content')
<div class="user-wrapper">
    <p>User</p>
    <div class="login-wrapper">
        <a href="{{ route('user.register') }}">新規登録ページ</a>
    </div>

    <div class="login-wrapper">
        <a href="{{ route('user.login') }}"> ログインページ</a>
    </div>
</div>

<div class="user-wrapper">
    <p>Owner</p>
    <div class="login-wrapper">
        <a href="{{ route('owner.register') }}">新規登録ページ</a>
    </div>

    <div class="login-wrapper">
        <a href="{{ route('owner.login') }}"> ログインページ</a>
    </div>
</div>


@endsection
