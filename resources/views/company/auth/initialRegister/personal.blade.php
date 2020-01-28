@extends('index')
    
@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/personal.css') }}">
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

// 郵便番号入力欄の自動遷移
function nextField(t, name, maxlength) {
  if (t.value.length >= maxlength) {
    t.form.elements[name].focus();
  }
}

const setPostal = () => {
  const postal_front = document.getElementById('postal_front').value;
  const postal_back = document.getElementById('postal_back').value;
  const postal = document.getElementById('postal');
  postal.value = postal_front + postal_back;
}
</script>
@endsection

@section('content')
<header>
	<div class="logo_container">
		<p class="logo">impro</p>
	</div>
</header>

<main>
	<div class="main-wrapper">
		@if(count($errors) > 0)
		<div class="error-container">
			<p>入力に問題があります。再入力して下さい。</p>
		</div>
		@endif

		<div class="title-container">
			<h3>企業情報登録</h3>
		</div>

		<form action="{{ route('company.register.personal.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
		
			@if(!isset($companyUser->invitation_user_id))
				<div class="edit-container-company">
					<div class="top-container">
						<div class="input-container linefirst-input">
							<p>
								会社名
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<input type="text" name="company_name" value="{{ old('company_name', isset($companyUser->Company->company_name) ? $companyUser->Company->company_name : '') }}">
							@if ($errors->has('company_name'))
								<div class="error-msg">
									<strong>{{ $errors->first('company_name') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container">
							<p>
								代表者名
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<input type="text" name="representive_name" value="{{ old('representive_name', isset($companyUser->Company->representive_name) ? $companyUser->Company->representive_name : '') }}">
							@if ($errors->has('representive_name'))
								<div class="error-msg">
									<strong>{{ $errors->first('representive_name') }}</strong>
								</div>
							@endif
						</div>
					</div>

					<div class="middle-container">
						<div class="input-container zipcode-container">
							<p>
								郵便番号
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<div class="zipcode-container__wrapper">
								<input type="text" name="zip_code_front" id="postal_front" value="{{ old('zip_code_front', isset($companyUser->Company->zip_code) ? mb_substr($companyUser->Company->zip_code, 0, 3) : '') }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
								<span class="hyphen"><hr></span>
								<input type="text" name="zip_code_back" id="postal_back" value="{{ old('zip_code_back', isset($companyUser->Company->zip_code) ? mb_substr($companyUser->Company->zip_code, 3) : '') }}" maxlength="4" onchange="setPostal()">
								<input type="hidden" name="zip_code" id="postal" value="{{ old('zip_code', isset($companyUser->Company->zip_code) ? $companyUser->Company->zip_code : '') }}">
							</div>
							@if ($errors->has('zip_code'))
								<div class="error-msg">
									<strong>{{ $errors->first('zip_code') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container prefecture-container">
							<p>
								都道府県
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<div class="select-arrow">
								<select name="address_prefecture" id="prefecture">
									@foreach(config('consts.pref') as $_pref)
									<option value="{{ $_pref }}" {{ old('address_prefecture', isset($companyUser->company->address_prefecture) ? $companyUser->company->address_prefecture : '') === $_pref ? 'selected' : '' }}>{{ $_pref }}</option>
									@endforeach
								</select>
							</div>
							@if ($errors->has('address_prefecture'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_prefecture') }}</strong>
								</div>
							@endif
						</div>
					</div>

					<div class="bottom-container">
						<div class="input-container linefirst-input">
							<p>
								市区町村・番地
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<input type="text" name="address_city" value="{{ old('address_city', isset($companyUser->Company->address_city) ? $companyUser->Company->address_city : '') }}">
							@if ($errors->has('address_city'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_city') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container">
							<p>
								建物名・部屋番号
								<span class="optional-label row-label">( 任意 )</span>
							</p>
							<input type="text" name="address_building" value="{{ old('address_building', isset($companyUser->Company->address_building) ? $companyUser->Company->address_building : '') }}">
							@if ($errors->has('address_building'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_building') }}</strong>
								</div>
							@endif
						</div>
					</div>
					<div class="bottom-container last">
						<div class="tel-container input-container">
							<p>
								電話番号
								<span class="required-label row-label">( 必須 )</span>
							</p>
							<div class="tel-container__wrapper">
								<input type="text" name="tel" id="tel" value="{{ old('tel', isset($companyUser->Company->tel) ? $companyUser->Company->tel : '') }}" maxlength="11" onblur="convert(this)">
							</div>
							@if ($errors->has('tel'))
								<div class="error-msg">
									<strong>{{ $errors->first('tel') }}</strong>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endif

			<div class="edit-container-personal edit-container">
				<div class="image-container">
					<div class="imgbox">
						<img id="profile_image_preview" src="{{ isset($companyUser->picture) ? $companyUser->picture : env('AWS_URL').'/common/upload4.png' }}" alt="プレビュー画像">
					</div> 
					<label for="picture">
						画像をアップロード
						<input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" onchange="setPreview(this)" style="display: none;">
					</label>
				</div>
				<div class="profile-container">
					<div class="input-container">
						<p>
							名前
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<input type="text" name="name" value="{{ old('name', $companyUser->name) }}">								
						@if ($errors->has('name'))
							<div class="error-msg">
								<strong>{{ $errors->first('name') }}</strong>
							</div>
						@endif
					</div>

					<div class="input-container">
						<p>
							所属部署
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<input type="text" name="department" value="{{ old('department', $companyUser->department) }}">
						@if ($errors->has('department'))
							<div class="error-msg">
								<strong>{{ $errors->first('department') }}</strong>
							</div>
						@endif
					</div>

					<div class="input-container">
						<p>
							職種
							<span class="optional-label row-label">( 任意 )</span>
						</p>
						
						<input type="text" name="occupation" value="{{ old('occupation', $companyUser->occupation) }}">
					</div>

					<div class="input-container last">
						<p>
							自己紹介
							<span class="optional-label row-label">( 任意 )</span>
						</p>
						<textarea type="text" name="self_introduction" cols="30" rows="10">{{ old('self_introduction', $companyUser->self_introduction) }}</textarea>
						@if ($errors->has('self_introduction'))
							<div class="error-msg">
								<strong>{{ $errors->first('self_introduction') }}</strong>
							</div>
						@endif
					</div>
				</div>
			</div>
			<input type="hidden" name="companyUser_id" value="{{ $companyUser->id }}">
			<input type="hidden" name="invitation_user_id" value="{{ $companyUser->invitation_user_id }}">
			
			<div class="btn-container">
				<button class="button" data-impro-button="once" type="button" onclick="submit();">確認</button>
			</div>
		</form>

		@if(!isset($companyUser->invitation_user_id))
		<div class="register-step">
			<div class="register-step-company-info">
				<p class="step1">Step1</p>
				<p class="company-info-title">企業情報登録</p>
			</div>

			<div class="register-step-bar">　</div>

			<div class="register-step-terms">
				<p class="step2">Step2</p>
				<p class="terms-title">ご利用規約</p>
			</div>
		</div>
		@endif
	</div>
</main>
@endsection

@section('asset-js')
<script src="{{ asset('js/common/convert-character.js') }}" defer></script>
@endsection