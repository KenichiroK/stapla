@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/index.css') }}">
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content')
<div>
    <p>TestView</p>
    <div>
        <form method="POST" action="{{ route('company.mail.company-send') }}">
        {{ csrf_field() }}
            <input type="meil" name="email" placeholder="メールアドレス">
            <div>
                <button type="submit">招待する</button>
            </div>
        </form>
    </div>
</div>
@endsection