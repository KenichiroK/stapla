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
			<li><a href="{{ route('company.setting.personalInfo.create') }}">個人情報の設定</a></li>
			<li><a href="{{ route('company.setting.email.create') }}" class="isActive">メールアドレスの設定</a></li>
		</ul>
  </div>

  <form action="{{ route('company.setting.email.sendEmail') }}" method="POST" enctype="multipart/form-data">
  @csrf
    <div id="setting" class="setting-container">
      <div class="plan-wrapper">
        <div class="title-container">
          <h3>メールアドレスの設定</h3>
        </div>
        
        <div class="short-input-container">
          <p>メールアドレス</p>
          <input type="text" name="email" value="{{ old('email', $company_user->email) }}">
          @if ($errors->has('email'))
            <div class="error-msg">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
          @endif
      </div>
    </div>

    <div class="btn01-container">
      <button type="button" onclick="submit();">メールを送信する</button>
    </div>
  </form>

</div>
@endsection
