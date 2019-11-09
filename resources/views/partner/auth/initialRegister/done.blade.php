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
			<div class="text-container">
				<h3>登録が完了しました。</h3>
			</div>

			<div class="btn-container">
				<a href="{{ route('partner.dashboard') }}">ダッシュボードに行く</a>
			</div>
		</div>
    </main>

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
    </footer>
</body>
</html>
