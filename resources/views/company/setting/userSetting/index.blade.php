@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/userSettng/index.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('preview');
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      console.log(e)
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
                <li><a href="/company/setting/general/create" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
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
			<li><a href="/company/setting/general/create" class="isActive">会社基本情報設定</a></li>
			<li><a href="/company/setting/email">会社その他の設定</a></li>
			<li><a href="/company/setting/notification">会社担当者設定</a></li>
			<li><a href="/company/setting/personal">アカウント設定</a></li>
			<li><a href="/company/setting/personal">個人情報の設定</a></li>
		</ul>
  </div>
  <div>
  <div class="charge-container__item">
        <ul class="charge-container__item__list">
            <li></li>
            <li>担当者名</li>
            <li>メールアドレス</li>
            <li>パートナー依頼中</li>
            <li>ステータス</li>
        </ul>
    </div>
    <div class="charge-container__content">
        <ul v-for="(item , index) in charge_list" :key="item.id" v-show="index < charge_displayNumber" class="charge-container__content__list" >
            <li><span class="icon">item.charge_icon</span></li>
            <li>item.charge_name </li>
            <li>item.charge_email</li>
            <li>item.charge_partner_request</li>
            <li>item.charge_status</li>
        </ul>
        <div class="charge-container__content__showmore">
            <p class="charge-container__content__showmore__btn" @click="showMoreCharge(4)">Show More</p>
        </div>
    </div>
  </div>
</div>
@endsection