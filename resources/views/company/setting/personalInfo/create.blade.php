@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/personalInfo/index.css') }}">
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    impro
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
                <li>
					<form method="POST" action="{{ route('company.logout') }}">
						@csrf
						<button type="submit">ログアウト</button>
					</form>
				</li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content');
<div class="main-wrapper">
	<div class="title-container">
		<h3>会社担当者設定</h3>
	</div>
	<div class="menu-container">
		<ul>
			<li><a href="/company/setting/general">会社基本情報設定</a></li>
			<li><a href="/company/setting/companyElse">会社その他の設定</a></li>
			<li><a href="/company/setting/userSetting">会社担当者設定</a></li>
			<li><a href="/company/setting/account">アカウント設定</a></li>
			<li><a href="/company/setting/personalInfo" class="isActive">個人情報の設定</a></li>
		</ul>
    </div>
    <div class="title-container">
        <h3>プロフィール管理画面</h3>
    </div>

    <form action="{{ url('/partner/profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container">
            <div class="title-container">
                <h4>プロフィール</h4>
            </div>
            <div class="edit-container">
                <div class="profile-container">
                    <div class="short-input-container">
                        <p>名前 / ニックネーム</p>
                            <input type="text" name="name" value="{{ old('name', $partner->name) }}" placeholder="HUMO TARO">
                    </div>

                    <div class="short-input-container">
                        <p>メールアドレス</p>
                            <input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}" placeholder="mailadress@gmail.com">
                    </div>

                    <div class="short-input-container">
                        <p>企業名</p>
                            <input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}" placeholder="株式会社 HUMO">
                    </div>

                    <div class="short-input-container">
                        <p>部署</p>
                            <input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}"  placeholder="ITそるーしょん">
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-container">
            <button type="submit">保存</button>
        </div>
    </form>
</div>
@endsection