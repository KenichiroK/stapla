@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/personalInfo/index.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('profile_image_preview');

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
            <li><a href="{{ route('company.setting.general.create') }}" >会社基本情報設定</a></li>
			<li><a href="{{ route('company.setting.companyElse.create') }}">会社その他の設定</a></li>
			<li><a href="{{ route('company.setting.userSetting.create') }}">会社担当者設定</a></li>
			<!-- <li><a href="{{ route('company.setting.account.create') }}">アカウント設定</a></li> -->
			<li><a href="{{ route('company.setting.personalInfo.create') }}" class="isActive">個人情報の設定</a></li>
		</ul>
    </div>

    <form action="{{ route('company.setting.personalInfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container white-bg-container">
            <div class="title-container">
                <h4>個人情報の設定</h4>
            </div>

            <div class="edit-container">
                <div class="image-container">
                    <div class="imgbox">
                        <img id="profile_image_preview" src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                    </div>
                    <label for="picture">
                        画像をアップロード
                        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" style="display: none;" onchange="setPreview(this)">
                    </label>
                    @if ($errors->has('picture'))
                        <div class="error-msg">
                            <strong>{{ $errors->first('picture') }}</strong>
                        </div>
                    @endif
                </div>
            
                <div class="profile_edit-container">
                    <div class="short-input-container">
                        <p>名前・ニックネーム</p>
                        <input type="text" name="name" value="{{ old('name', $company_user->name) }}">
                        @if ($errors->has('name'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>メールアドレス</p>
                        <p class="text_content">{{ $company_user->email }}</p>
                    </div>

                    <div class="short-input-container">
                        <p>部署</p>
                        <input type="text" name="department" value="{{ old('department', $company_user->department) }}">
                        @if ($errors->has('department'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('department') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container last">
                        <p>職種</p>
                        <input type="text" name="occupation" value="{{ old('occupation', $company_user->occupation) }}">
                        @if ($errors->has('occupation'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('occupation') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="btn01-container">
            <button type="button" onclick="submit();">保存</button>
        </div>
    </form>
</div>
@endsection
