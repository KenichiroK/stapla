@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
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
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
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
    @if ($completed)
        <div class="complete-container">
            <p>{{ $completed }}</p>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="error-container">
            <p>入力に問題があります。再入力して下さい。</p>
        </div>
    @endif
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

    <form action="{{ url('/company/setting/personalInfo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container">
            <div class="title-container">
                <h4>個人情報の設定</h4>
            </div>

            <div class="edit-container">
                <div class="image-container">
                    @if ($companyUser)
                        <img src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                    @else
                        <img src="/{{ str_replace('public/', 'storage/', 'images/default/preview.jpeg') }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                    @endif
                    <label for="picture">
                        画像をアップロード
                        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" style="display: none;" onchange="setPreview(this)">
                    </label>
                    @if ($errors->has('picture'))
                        <div>
                            <strong style='color: #e3342f;'>{{ $errors->first('picture') }}</strong>
                        </div>
                    @endif
                </div>
            
                <div class="profile-container">
                    <div class="short-input-container">
                        <p>名前・ニックネーム</p>
                        @if ($companyUser)
                            <input type="text" name="name" value="{{ old('name', $companyUser->name) }}">
                        @else
                            <input type="text" name="name" value="{{ old('name') }}">
                        @endif
                        @if ($errors->has('name'))
                            <div>
                                <strong style='color: #e3342f;'>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>メールアドレス</p>
                        @if ($companyUser)
                            <input type="text" name="email" value="{{ old('email', $companyUser->companyUserAuth->email) }}">
                        @else
                            <input type="text" name="email" value="{{ old('email') }}">
                        @endif
                        @if ($errors->has('email'))
                            <div>
                                <strong style='color: #e3342f;'>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>企業名</p>
                        {{ $companyUser->company->company_name }}
                    </div>

                    <div class="short-input-container">
                        <p>部署</p>
                        @if ($companyUser)
                            <input type="text" name="department" value="{{ old('department', $companyUser->department) }}">
                        @else
                            <input type="text" name="department" value="{{ old('department') }}">
                        @endif
                        @if ($errors->has('department'))
                            <div>
                                <strong style='color: #e3342f;'>{{ $errors->first('department') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>職種</p>
                        @if ($companyUser)
                            <input type="text" name="occupation" value="{{ old('occupation', $companyUser->occupation) }}">
                        @else
                            <input type="text" name="occupation" value="{{ old('occupation') }}">
                        @endif
                        @if ($errors->has('occupation'))
                            <div>
                                <strong style='color: #e3342f;'>{{ $errors->first('occupation') }}</strong>
                            </div>
                        @endif
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
