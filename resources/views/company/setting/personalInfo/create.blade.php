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

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $companyUser->name }}
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
        <img src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="プロフィール画像">
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
                        <div class="imgbox">
                            <img id="profile_image_preview" src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                        </div>
                    @else
                        <div class="imgbox">
                            <img src="../../../images/upload2.png" alt="">
                            <!-- <img src="/{{ str_replace('public/', 'storage/', 'images/default/preview.jpeg') }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px"> -->
                        </div>
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
                        {{ $companyUser->companyUserAuth->email }}
                    </div>

                    <div class="short-input-container">
                        <p>企業名</p>
                        <input type="text" name="company" value="">
                        <!-- {{ $companyUser->company->company_name }} -->
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

                    <div class="short-input-container last">
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
