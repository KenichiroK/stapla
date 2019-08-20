<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
    <link href="{{ mix('css/auth/login/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>
    <header>
        <div class="logo_container">
            <p class="logo">impro</p>
        </div>
    </header>

    <main>
        <div class="main_container">
            <div class="title_wrapper">
                <h1 class="text">フリーランスの方用 新規会員登録</h1>
            </div>

            <div class="form_wrapper">
                <form method="POST" action="/partner/register/{{ $company_id }}">
                    @csrf
                    <div class="input_wrapper">
                        <h4 class="title">メールアドレス</h4>
                        <input class="input_text" type="text" name="email" value="{{ $email }}" placeholder="impro@example.com">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: #e3342f;">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">パスワード</h4>
                        <input class="input_text" type="password" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: #e3342f;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">パスワード確認</h4>
                        <input class="input_text" type="password" name="password_confirmation">
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">企業ID</h4>
                        <input class="input_text" type="text" name="company_id" value="{{ $company_id }}" placeholder="impro@example.com">
                    </div>

                    <div class="checkbox_wrapper">
                        <a href="#">ご利用規約</a>
                        <span>に同意して</span>
                    </div>

                    <div class="button_wrapper">
                        <button type="submit" class="text">新規会員登録</button>
                    </div>
                </form>

                <div class="signup_wrapper">
                    <a href="/partner/login">ログイン</a>
                </div>
                
            </div>
        </div>
    </main>

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
    </footer>
</body>
</html>
