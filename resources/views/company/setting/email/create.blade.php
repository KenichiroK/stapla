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
  @include('company.setting.common.menuTab', ['activeClass' => 'email'])

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
            <button type="submit">メールアドレスを変更する</button>
        </div>
    </div>
  </form>

</div>
@endsection
