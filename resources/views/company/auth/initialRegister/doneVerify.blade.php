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
        <div class="text-container">
            <h3>Eメール認証が完了しました。</h3>
        </div>

        <div class="btn-container">
            @if(isset($company_user->name))
                <a href="{{ route('company.dashboard') }}">ダッシュボードに行く</a>
            @else
                <a href="{{ route('company.register.personal.create') }}">ユーザー情報を登録する</a>
            @endif
        </div>
    </div>
</main>

<!-- <footer>
    <span>ご利用規約</span>
    <span>プライバシーポリシー</span>
</footer> -->
@endsection
