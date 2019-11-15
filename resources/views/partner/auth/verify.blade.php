@extends('index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/done.css') }}">
@endsection
    
@section('content')
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

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    確認リンクがパートナーのメールアドレスに送信されました。
                                </div>
                            @endif
                            続行する前に、電子メールで確認リンクを確認してください。メールが届かない場合は、 <a href="{{ route('partner.verification.resend') }}">ここをクリックして別のメールをリクエストしてください</a>。
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
@endsection