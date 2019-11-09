<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ env('AWS_URL') }}/common/impro_favicon.png">
    
	<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/done.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>
    <header>
        <div class="logo_container">
            <p class="logo">impro</p>
        </div>
    </header>

    <main>
        <div class="main-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">登録したメールを確認してください。</div>
                            <div class="card-body">続行する前に、電子メールで確認リンクを確認してください。メールが届かない場合は、 <br/>
                            <a href="{{ route('company.PreRegister') }}">ここをクリックしてもう一度、新規会員登録をおこなってください</a>。</div>

                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        新しい確認リンクがメールアドレスに送信されました。
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
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