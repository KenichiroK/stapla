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
        <h3>プロフィール設定</h3>
    </div>

    <div class="menu-container">
		<ul>
			<li><a href="" class="isActive">プロフィール</a></li>
			<li><a href="">メールアドレス・パスワード設定</a></li>
		</ul>
	</div>

    <form action="{{ route('partner.setting.profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container">
            <div class="title-container">
                <h4>プロフィール</h4>
            </div>

        
            <div class="edit-container">
                <div class="image-container">
                    @if (Auth::user())
                        <div class="imgbox">
                            <img id="profile_image_preview" src="{{ Auth::user()->picture }}" alt="プレビュー画像">
                        </div>
                    @else
                        <img id="profile_image_preview" src="{{ env('AWS_URL') }}/common/preview.jpeg" alt="プレビュー画像" width="140px" height="140px">
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
                        @if (Auth::user())
                            <input type="text" name="nickname" value="{{ old('nickname', Auth::user()->nickname) }}">
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
                        @if (Auth::user())
                            <input type="text" name="occupations" value="{{ old('occupations', Auth::user()->occupations) }}">
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
                        @if (Auth::user())
                            <input type="text" name="twitter" value="{{ old('twitter', Auth::user()->twitter) }}">
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
                        @if (Auth::user())
                            <input type="text" name="facebook" value="{{ old('facebook', Auth::user()->facebook) }}">
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
                        @if (Auth::user())
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
                        @if (Auth::user())
                            <input type="text" name="instagram" value="{{ old('instagram', Auth::user()->instagram) }}">
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
                        @if (Auth::user())
                            <input type="text" name="relatedlinks" value="{{ old('relatedlinks', Auth::user()->relatedlinks) }}">
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
                        @if (Auth::user())
                            <textarea name="introduction" id="" cols="30" rows="10">{{ old('introduction', Auth::user()->introduction) }}</textarea>
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
            <!-- <div class="preview-btn">
                <button type="submit">プレビュー</button>
            </div> -->
            <div class="save-btn">
                <button type="button" onclick="submit();">保存</button>
            </div>
        </div>
    </form>
</div>
@endsection
