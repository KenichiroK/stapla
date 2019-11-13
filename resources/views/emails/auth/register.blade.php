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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">登録したメールを確認してください。</div>

                    <div class="card-body">
                    
                        <div class="alert alert-success" role="alert">
                            新しい確認リンクがメールアドレスに送信されました。
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