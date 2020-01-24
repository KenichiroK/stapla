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
            <h3>登録が完了しました。</h3>
        </div>

        <div class="btn-container">
            <a href="{{ route('company.dashboard') }}">ダッシュボードに行く</a>
        </div>
    </div>
</main>
@endsection