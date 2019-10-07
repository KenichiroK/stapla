@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
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
			<li><a href="{{ route('company.setting.general.create') }}">会社基本情報設定</a></li>
			<li><a href="{{ route('company.setting.companyElse.create') }}">会社その他の設定</a></li>
			<li><a href="{{ route('company.setting.userSetting.create') }}" class="isActive">会社担当者設定</a></li>
			<!-- <li><a href="{{ route('company.setting.account.create') }}">アカウント設定</a></li> -->
			<li><a href="{{ route('company.setting.personalInfo.create') }}">個人情報の設定</a></li>
		</ul>
  </div>
  <div id="charge" class="charge-container white-bg-container">
    <div class="title-container">
        <h3>会社担当者設定</h3>
        <div class="btn-a-container">
            <a href="{{ route('company.invite.company-user.invite') }}">担当者追加</a>
        </div>
    </div>
    <div class="charge-container_item">
        <ul>
            <li>担当者名</li>
            <li>メールアドレス</li>
            <li>パートナー依頼中</li>
            <li>ステータス</li>
        </ul>
    </div>
    <div class="charge-container_content">
        @foreach($companyUsers as $companyUser)
        <ul>
            <li>
                <div class="name-container">
                    <div class="name-container__img-container">
                    <img src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="">
                    </div>
                    {{ $companyUser->name }}
                </div>
            </li>
            <li>{{ $companyUser->email }}</li>
            <li>管理者</li>
            <li>登録済み</li>
        </ul>
        @endforeach
        
        <div class="showmore-wrp">
            <p id="more_btn" class="showmore_btn">もっと見る</p>
        </div>
    </div>
</div>
@endsection
