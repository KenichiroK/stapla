@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/profile/index.css') }}">
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
            {{ $partner->name }}
        </div>

        <div class="icon-imgbox">
            <img src="{{ asset('images/icon_small-down.png') }}" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('partner.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <a href="/partner/profile">
            <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
        </a>
    </div>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <a href="/company/dashboard">
                <div class="menu__container--label">
                    <div class="menu-label">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                </div>
            </a>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_home.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/partner/dashboard">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_dashboard.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_invoices.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_help-center.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/partner/setting/invoice" class="isActive">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_setting-active.png') }}" alt="">
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
        <h3>プロフィール管理画面</h3>
    </div>

    <div class="menu-container">
		<ul>
			<li><a href="" class="isActive">プロフィール</a></li>
			<li><a href="">メールアドレス・パスワード設定</a></li>
			<li><a href="">通知設定</a></li>
		</ul>
	</div>

    <form action="{{ url('/partner/profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container">
            <div class="title-container">
                <h4>プロフィール</h4>
            </div>

        
            <div class="edit-container">
                <div class="image-container">
                    @if ($partner)
                        <div class="imgbox">
                            <img id="profile_image_preview" src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プレビュー画像">
                        </div>
                    @else
                        <img id="profile_image_preview" src="/{{ str_replace('public/', 'storage/', 'images/default/preview.jpeg') }}" alt="プレビュー画像" width="140px" height="140px">
                    @endif
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

                <div class="profile-container">
                    <div class="short-input-container">
                        <p>名前 / ニックネーム</p>
                        @if ($partner)
                            <input type="text" name="nickname" value="{{ old('nickname', $partner->nickname) }}">
                        @else
                            <input type="text" name="nickname" value="{{ old('nickname') }}">
                        @endif
                        @if ($errors->has('nickname'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>職種</p>
                        @if ($partner)
                            <input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}">
                        @else
                            <input type="text" name="occupations" value="{{ old('occupations') }}">
                        @endif
                        @if ($errors->has('occupations'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('occupations') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Twitter</p>
                        @if ($partner)
                            <input type="text" name="twitter" value="{{ old('twitter', $partner->twitter) }}">
                        @else
                            <input type="text" name="twitter" value="{{ old('twitter') }}">
                        @endif
                        @if ($errors->has('twitter'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('twitter') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Facebook</p>
                        @if ($partner)
                            <input type="text" name="facebook" value="{{ old('facebook', $partner->facebook) }}">
                        @else
                            <input type="text" name="facebook" value="{{ old('facebook') }}">
                        @endif
                        @if ($errors->has('facebook'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('facebook') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Github</p>
                        @if ($partner)
                            <input type="text" name="github" value="{{ old('github') }}">
                        @else
                            <input type="text" name="github" value="{{ old('github') }}">
                        @endif
                        @if ($errors->has('github'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('github') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Instagram</p>
                        @if ($partner)
                            <input type="text" name="instagram" value="{{ old('instagram', $partner->instagram) }}">
                        @else
                            <input type="text" name="instagram" value="{{ old('instagram') }}">
                        @endif
                        @if ($errors->has('instagram'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('instagram') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Webサイト・ブログ</p>
                        @if ($partner)
                            <input type="text" name="relatedlinks" value="{{ old('relatedlinks', $partner->relatedlinks) }}">
                        @else
                            <input type="text" name="relatedlinks" value="{{ old('relatedlinks') }}">
                        @endif
                        @if ($errors->has('relatedlinks'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('relatedlinks') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="textarea-container">
                        <p>自己紹介</p>
                        @if ($partner)
                            <textarea name="introduction" id="" cols="30" rows="10">{{ old('introduction', $partner->introduction) }}</textarea>                            
                        @else
                            <textarea name="introduction" id="" cols="30" rows="10">{{ old('introduction') }}</textarea>
                        @endif
                        @if ($errors->has('introduction'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('introduction') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-container">
            <div class="preview-btn">
                <button type="submit">プレビュー</button>
            </div>
            <div class="save-btn">
                <button type="submit">保存</button>
            </div>
        </div>
    </form>
</div>
@endsection
