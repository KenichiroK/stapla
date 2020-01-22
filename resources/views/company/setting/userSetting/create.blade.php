@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/userSetting/index.css') }}">
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
    @include('company.setting.common.menuTab', ['activeClass' => 'userSetting'])

    <div id="charge" class="charge-container white-bg-container">
        <div class="title-container">
            <h3>会社担当者設定</h3>
            <div class="btn-a-container">
                <a href="{{ route('company.invitePreRegister') }}">担当者追加</a>
            </div>
        </div>
        <div class="charge-container_item">
            <ul>
                <li>担当者名</li>
                <li>メールアドレス</li>
                <li>ステータス</li>
            </ul>
        </div>
        <div class="charge-container_content">
            @foreach($companyUsers as $companyUser)
            <ul>
                {{-- NOTE: 契約書締結フロー実装後デザイン変更 --}}
                @if($companyUser->is_agree == 1)
                <li>
                    <div class="name-container">
                        <div class="name-container__img-container">
                            <img src="{{ $companyUser->picture }}" alt="">
                        </div>
                        {{ $companyUser->name }}
                    </div>
                </li>
                <li>{{ $companyUser->email }}</li>
                <li>登録済み</li>
                @else
                <li>
                    <div class="name-container">
                        <div class="name-container__img-container">
                            <img src="{{ env('AWS_URL').'/common/dummy_profile_icon.png' }}" alt="">
                        </div>
                        設定中
                    </div>
                </li>
                <li>{{ $companyUser->email }}</li>
                <li>招待中</li>
                @endif
            </ul>
            @endforeach
            
            <div class="showmore-wrp">
                <p id="more_btn" class="showmore_btn">もっと見る</p>
            </div>
        </div>
    </div>
</div>
@endsection
