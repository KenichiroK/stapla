@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/userSetting/index.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('preview');
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
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

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>設定</h3>
	</div>
	<div class="menu-container">
		<ul>
			<li><a href="/company/setting/general">会社基本情報設定</a></li>
			<li><a href="/company/setting/companyElse">会社その他の設定</a></li>
			<li><a href="/company/setting/userSetting"  class="isActive">会社担当者設定</a></li>
			<li><a href="/company/setting/account">アカウント設定</a></li>
			<li><a href="/company/setting/personalInfo">個人情報の設定</a></li>
		</ul>
  </div>
  <div id="charge" class="charge-container">
    <div class="charge-container__top-wrapper">
        <div class="title-container">
            <h3>会社担当者設定</h3>
        </div>
    </div>
    <div class="charge-container__item">
        <ul class="charge-container__item__list" style="display: flex">
            <li>担当者名</li>
            <li>メールアドレス</li>
        </ul>
    </div>
    <div class="charge-container__content">
        @foreach($companyUsers as $companyUser)
        <ul class="charge-container__content__list">
            <li>
                <div class="name-container">
                    <div class="name-container__img-container">
                        <img class="icon" src="" alt="">
                    </div>
                    {{ $companyUser->name }}
                </div>
            </li>
            <li>{{ $companyUser->companyUserAuth->email }}</li>
        </ul>
        @endforeach
        
        <div class="charge-container__content__showmore">
            <p class="charge-container__content__showmore__btn">もっと見る<i class="arrow fas fa-angle-down"></i></p>
        </div>
    </div>
    <div class="btn-container">
        <a href="/company/companyMail">担当者追加</a>
    </div>
</div>
@endsection
