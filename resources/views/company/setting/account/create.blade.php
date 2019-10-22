@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/account/index.css') }}">
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
			<!-- <li><a href="{{ route('company.setting.companyElse.create') }}">会社その他の設定</a></li> -->
			<li><a href="{{ route('company.setting.userSetting.create') }}">会社担当者設定</a></li>
			<li><a href="{{ route('company.setting.account.create') }}" class="isActive">アカウント設定</a></li>
			<li><a href="{{ route('company.setting.personalInfo.create') }}">個人情報の設定</a></li>
		</ul>
    </div>
    <!-- アカウント設定 -->
    <div id="setting" class="setting-container">
      <div class="plan-wrapper">
          <div class="title-container">
            <h3>アカウント設定</h3>
          </div>
          <div class="plan">プラン</div>
          <div class="plan-name">ライトプラン（年払い）</div>
          <div class="btn-container">
            <button type="button" onclick="submit();">プラン変更</button>
          </div>
      </div>
    </div>
</div>
@endsection
