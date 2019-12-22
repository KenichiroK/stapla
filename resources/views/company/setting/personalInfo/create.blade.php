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
	@include('company.setting.common.menuTab')

    <form action="{{ route('company.setting.personalInfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container white-bg-container">
            <div class="title-container">
                <h4>個人情報の設定</h4>
            </div>

            <div class="edit-container">
                <div class="image-container">
                    <div class="imgbox">
                        <img id="profile_image_preview" src="{{ $company_user->picture }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
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
