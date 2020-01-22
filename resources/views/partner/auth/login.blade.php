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
            <img src="{{ env('AWS_URL') }}/common/logo2.png" alt="logo">
        </div>
    </div>
</header>

<main>
    <div class="main_container">
        <div class="title_wrapper">
            <h1 class="text">フリーランスの方用 ログイン</h1>
        </div>

        <div class="form_wrapper">
            <form method="POST" action="{{  route('partner.login')  }}">
                @csrf
                <div class="input_wrapper">
                    <h4 class="title">ユーザーID</h4>
                    <input class="input_text" type="email" name="email" placeholder="ユーザーネーム又はメールアドレス" value={{ old('email') }}>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input_wrapper">
                    <h4 class="title">パスワード</h4>
                    <div class="pass-input-wrp">
                        <input class="input_text" type="password" id="password" name="password">
                        <p id="toggle-password" onclick="isDisplayPw()">表示</p>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="checkbox_wrapper">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">ログインしたままにする</label>
                </div>
                
                <div class="button_wrapper">
                    <button class="text" id="button" data-impro-button="once" type="button" onclick="submit();">ログイン</button>
                </div>
            </form>

            <div class="forget_password_wrapper">
                <a href="{{  route('partner.password.request')  }}">パスワードをお忘れの場合はこちら</a>
            </div>
            
        </div>
    </div>
</main>

<!-- <footer>
    <span class="tos"><a href="/terms">ご利用規約</a></span>
    <span class="privacy"><a href="/privacy">プライバシーポリシー</a></span>
</footer> -->
@endsection

@section('asset-js')
<script>
var count = 0;
var isDisplayPw = function () {
    count++
    var pw = document.getElementById('password');
    var pwCheck = document.getElementById('toggle-password');

    if(count%2 == 1){
        pw.setAttribute('type', 'text');
        pwCheck.innerHTML = '非表示';
    } else{
        pw.setAttribute('type', 'password');
        pwCheck.innerHTML = '表示';
    }
}

// Enterキーでログイン
window.onload=function(){
    document.getElementById("password").addEventListener('keypress',function(e){
        if(e.which == 13){
            document.getElementById("button").click() ;
        }
    });
};
</script>
@endsection
