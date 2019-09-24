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
                        <button class="text" type="button" onclick="submit();">変更する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
    </footer>
</body>
</html>
