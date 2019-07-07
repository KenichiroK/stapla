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
      console.log(e)
      preview.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $partner->name }}
</div>
<div class="navbar-item">
    <a href="/partner/profile">
        <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
    </a>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/partner/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/partner/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/partner/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/partner/setting/invoice" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('partner.logout') }}">
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
        <h3>プロフィール管理画面</h3>
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
                        <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                    @else
                        <img src="/{{ str_replace('public/', 'storage/', 'images/default/preview.jpeg') }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
                    @endif
                    <label for="picture">
                        画像をアップロード
                        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" style="display: none;" onchange="setPreview(this)">
                    </label>
                </div>

                <div class="profile-container">
                    <div class="short-input-container">
                        <p>名前 / ニックネーム</p>
                        @if ($partner)
                            <input type="text" name="nickname" value="{{ old('nickname', $partner->nickname) }}">
                            @if ($errors->has('nickname'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('nickname') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="nickname" value="{{ old('nickname') }}">
                            @if ($errors->has('nickname'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('nickname') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="short-input-container">
                        <p>職種</p>
                        @if ($partner)
                            <input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}">
                            @if ($errors->has('occupations'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('occupations') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="occupations" value="{{ old('occupations') }}">
                            @if ($errors->has('occupations'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('occupations') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Twitter</p>
                        @if ($partner)
                            <input type="text" name="twitter" value="{{ old('twitter', $partner->twitter) }}">
                            @if ($errors->has('twitter'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('twitter') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="twitter" value="{{ old('twitter') }}">
                            @if ($errors->has('twitter'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('twitter') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Facebook</p>
                        @if ($partner)
                            <input type="text" name="facebook" value="{{ old('facebook', $partner->facebook) }}">
                            @if ($errors->has('facebook'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('facebook') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="facebook" value="{{ old('facebook') }}">
                            @if ($errors->has('facebook'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('facebook') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Github</p>
                        @if ($partner)
                            <input type="text" name="github" value="{{ old('github') }}">
                            @if ($errors->has('github'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('github') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="github" value="{{ old('github') }}">
                            @if ($errors->has('github'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('github') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Instagram</p>
                        @if ($partner)
                            <input type="text" name="instagram" value="{{ old('instagram', $partner->instagram) }}">
                            @if ($errors->has('instagram'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('instagram') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="instagram" value="{{ old('instagram') }}">
                            @if ($errors->has('instagram'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('instagram') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="long-input-container">
                        <p>Webサイト・ブログ</p>
                        @if ($partner)
                            <input type="text" name="relatedlinks" value="{{ old('relatedlinks', $partner->relatedlinks) }}">
                            @if ($errors->has('relatedlinks'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('relatedlinks') }}</strong>
                                </div>
                            @endif
                        @else
                            <input type="text" name="relatedlinks" value="{{ old('relatedlinks') }}">
                            @if ($errors->has('relatedlinks'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('relatedlinks') }}</strong>
                                </div>					
                            @endif
                        @endif
                    </div>

                    <div class="textarea-container">
                        <p>自己紹介</p>
                        @if ($partner)
                            <textarea name="introduction" id="" cols="30" rows="10">{{ old('introduction', $partner->introduction) }}</textarea>                            
                            @if ($errors->has('introduction'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('introduction') }}</strong>
                                </div>
                            @endif
                        @else
                            <textarea name="introduction" id="" cols="30" rows="10">{{ old('introduction') }}</textarea>                            
                            @if ($errors->has('introduction'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('introduction') }}</strong>
                                </div>					
                            @endif
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
