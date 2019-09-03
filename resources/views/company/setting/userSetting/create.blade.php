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

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="../../../images/icon_small-down.png" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection


@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
                        </div>
                        <div class="textbox">
                            設定
                        </div>
                    </a>
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
			<!-- <li><a href="/company/setting/account">アカウント設定</a></li> -->
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
            <li>パートナー依頼中</li>
            <li>ステータス</li>
        </ul>
    </div>
    <div class="charge-container__content">
        @foreach($companyUsers as $companyUser)
        <ul class="charge-container__content__list">
            <li>
                <div class="name-container">
                    <div class="name-container__img-container">
                    <img src="../../../images/photoimg.png" alt="">
                    </div>
                    {{ $companyUser->name }}
                </div>
            </li>
            <li>{{ $companyUser->companyUserAuth->email }}</li>
            <li>管理者</li>
            <li>登録済み</li>
        </ul>
        @endforeach
        
        <div class="charge-container__content__showmore">
            <p class="charge-container__content__showmore__btn">もっと見る</p>
        </div>
    </div>
    <div class="btn-container">
        <a href="/company/invite/company">担当者追加</a>
    </div>
</div>
@endsection
