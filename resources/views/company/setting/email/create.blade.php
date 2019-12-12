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
  @if (session('completed'))
  <div class="complete-container">
      <p>{{ session('completed') }}</p>
  </div>
  @endif

  @if(count($errors) > 0)
  <div class="error-container">
      <p>入力に問題があります。再入力して下さい。</p>
  </div>
  @endif

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

    <div class="body-container">
      <div class="edit-container">
        <div class="profile-container">
          <div class="short-input-container">
            <p>メールアドレス</p>
            @if (Auth::user())
                <input type="text" name="email" value="{{ old('email', Auth::user()->email) }}">
            @else
                <input type="text" name="email" value="{{ old('email') }}">
            @endif

            @if ($errors->has('email'))
                <div class="error-msg">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="btn-container">
        <div class="save-btn">
            <button type="button" onclick="submit();">メールアドレスを変更する</button>
        </div>
    </div>
  </form>

</div>
@endsection
