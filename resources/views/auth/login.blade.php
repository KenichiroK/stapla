<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
    <link href="{{ mix('css/auth/login/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
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
            <p class="logo">impro</p>
        </div>
    </header>

    <main>
        <div class="main_container">
            <div class="title_wrapper">
                <h1 class="text">ログイン</h1>
            </div>

            <div class="form_wrapper">
                <form action="">
                    @csrf
                    <div class="input_wrapper">
                        <h4 class="title">メールアドレス</h4>
                        <input class="input_text" type="email" name="email" placeholder="メールアドレス">
                    </div>

                    <div class="input_wrapper">
                        <h4 class="title">パスワード</h4>
                        <input class="input_text" type="password" name="password">
                    </div>

                    <div class="checkbox_wrapper">
                        <input id="check" type="checkbox">
                        <label for="check">ログインしたままにする</label>
                    </div>

                    <div class="button_wrapper">
                        <button class="text">ログイン</button>
                    </div>
                </form>

                <div class="signup_wrapper">
                    <a href="/register">新規会員登録</a>
                </div>

                <div class="forget_password_wrapper">
                    <a href="#">パスワードをお忘れの場合はこちら</a>
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
