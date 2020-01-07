@extends('index')

@section('assets')
<link href="{{ mix('css/auth/login/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<header>
    <div class="logo_container">
        <p class="logo">impro</p>
    </div>
</header>

<main>
    <div class="main_container">
        <div class="title_wrapper">
            <h1 class="text">パスワード再設定</h1>
        </div>

        <div class="form_wrapper">
            <form method="POST" action="">
                @csrf
                <div class="input_wrapper">
                    <h4 class="title">新しいパスワード</h4>
                    <input class="input_text" type="password" name="password" required>
                </div>

                <div class="input_wrapper">
                    <h4 class="title">新しいパスワード 確認</h4>
                    <input class="input_text" type="password" name="password_confirm" required>
                </div>
                
                <div class="button_wrapper">
                    <button class="text" type="submit">変更する</button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer>
    <span>ご利用規約</span>
    <span>プライバシーポリシー</span>
</footer>
@endsection
