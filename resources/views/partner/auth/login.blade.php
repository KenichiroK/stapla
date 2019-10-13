<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
    <link href="{{ mix('css/auth/login/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body: {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
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
                            <p id="toggle-password" onclick="myfunc()">表示</p>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="checkbox_wrapper">
                        <input id="check" type="checkbox">
                        <label for="check">ログインしたままにする</label>
                    </div>

                    <div class="button_wrapper">
                        <button class="text" type="button" onclick="submit();">ログイン</button>
                    </div>
                </form>

                <!-- 現在、パートナーの自発的な新規会員登録は行わない -->
                <div class="signup_wrapper">
                    <a href="#">新規会員登録</a>
                </div>

                <div class="forget_password_wrapper">
                    <a href="#">パスワードをお忘れの場合はこちら</a>
                </div>
                
            </div>
        </div>
    </main>

    <footer>
        <span class="tos"><a href="/terms">ご利用規約</a></span>
        <span class="privacy"><a href="/privacy">プライバシーポリシー</a></span>
    </footer>

    <script>
        let count = 0;
        let myfunc = function () {
            count++
            let pw = document.getElementById('password');
            let pwCheck = document.getElementById('toggle-password');

            if(count%2 == 1){
                pw.setAttribute('type', 'text');
                pwCheck.innerHTML = '非表示';
            } else{
                pw.setAttribute('type', 'password');
                pwCheck.innerHTML = '表示';
            }
        }
    </script>
</body>
</html>
