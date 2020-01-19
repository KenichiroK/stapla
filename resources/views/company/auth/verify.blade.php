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
                        <div class="card-body">続行する前に、電子メールで確認リンクを確認してください。メールが届かない場合は、 <br/>
                            <a href="{{ route('company.verification.resend') }}">ここをクリックしてもう一度、新規会員登録をおこなってください。</a>
                        </div>

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
@endsection