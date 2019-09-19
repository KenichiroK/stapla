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
            <div class="btn-container">
                <a href="/company/invite/company">担当者追加</a>
            </div>
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
        <ul class="company_user charge-container__content__list">
            <li>
                <div class="name-container">
                    <div class="name-container__img-container">
                    <img src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="">
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
            <p id="more_btn" class="charge-container__content__showmore__btn">もっと見る</p>
        </div>
    </div>
    <!-- <div class="btn-container">
        <a href="/company/invite/company">担当者追加</a>
    </div> -->
</div>
@endsection
