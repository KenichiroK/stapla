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
                <h1 class="text">パスワードを設定してください</h1>
            </div>

            <div class="form_wrapper">
                <form method="POST" action="">
                    @csrf
                    <div class="input_wrapper">
                        <input class="input_text" type="hidden" name="email" value="{{ $request->email }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">パスワード</h4>
                        <input class="input_text" type="password" name="password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">パスワード確認</h4>
                        <input class="input_text" type="password" name="password_confirmation">
                    </div>

                    <div class="input_wrapper">
                        <input class="input_text" type="hidden" name="company_id" value="{{ $request->company_id }}">
                        @if ($errors->has('company_id'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('company_id') }}</strong>
                            </div>
                        @endif
                    </div>

                    <!-- <div class="checkbox_wrapper">
                        <a href="#">ご利用規約</a>
                        <span>に同意して</span>
                    </div> -->

                    <div class="button_wrapper">
                        <button type="button" onclick="submit();" class="text">新規会員登録</button>
                    </div>
                </form>

                <!-- <div class="signup_wrapper">
                    <a href="{{ route('partner.login') }}">ログイン</a>
                </div> -->
                
            </div>
        </div>
    </main>

    <!-- <footer>
        <span class="tos">ご利用規約</span>
        <span class="privacy">プライバシーポリシー</span>
    </footer> -->
</body>
</html>
