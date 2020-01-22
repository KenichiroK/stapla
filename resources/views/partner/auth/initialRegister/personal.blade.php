@extends('index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/personal.css') }}">
<script>
function setPreview(input) {
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
function nextField(t, name ,maxlength) {
	if(t.value.length >= maxlength) {
		t.form.elements[name].focus();
	}
}

window.onload = function () {
  setPostal();
}

function setPostal(){
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
		<div class="title-container">
			<h3>プロフィール設定</h3>
		</div>

		<form action="{{ route('partner.register.personal.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="edit-container top">
				<div class="image-container">
					<div class="imgbox">
						<img id="profile_image_preview" src="{{ isset($partner->picture) ? $partner->picture : asset('images/upload4.png') }}" alt="プレビュー画像">
					</div> 
					<label for="picture">
						画像をアップロード
						<input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" onchange="setPreview(this)" style="display: none;">
					</label>
				</div>
				<div class="profile-container">

					<div class="input-container">
						<p>
							名前・ニックネーム{{$partner->name}}
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<input type="text" name="name" value="{{ old('name', $partner->name) }}">								
						@if($errors->has('name'))
							<div class="error-msg">
								<strong>{{ $errors->first('name') }}</strong>
							</div>
						@endif
					</div>

					<div class="input-container">
						<p>
							職種
							<span class="optional-label row-label">( 任意 )</span>
						</p>
						<input type="text" name="occupations" value="{{ old('occupations', $partner->occupations) }}" placeholder="例）UIデザイナー、フロントエンドエンジニア、etc">	
						@if($errors->has('occupations'))
							<div class="error-msg">
								<strong>{{ $errors->first('occupations') }}</strong>
							</div>
						@endif
					</div>

					<div class="input-container last">
						<p>
                            プロフィールメッセージ
                            <span class="optional-label row-label">( 任意 )</span>
                        </p>
						<textarea type="text" name="introduction" cols="30" rows="10">{{ old('introduction', $partner->introduction) }}</textarea>
						@if($errors->has('introduction'))
							<div class="error-msg">
								<strong>{{ $errors->first('introduction') }}</strong>
							</div>
						@endif
					</div>
					
				</div>
			</div>

			<div class="address-container">
				<div class="above-address-container">
					<div class="zipcode-container input-container">
						<p>
							郵便番号
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<div class="zipcode-container__wrapper">
							<input type="text" name="zip_code_front" id="postal_front" value="{{ old('zip_code_front', mb_substr($partner->zip_code, 0, 3)) }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
							<span class="hyphen"><hr></span>
							<input type="text" name="zip_code_back" id="postal_back" value="{{ old('zip_code_back', mb_substr($partner->zip_code, 3)) }}" maxlength="4" onchange="setPostal()">
							<input type="hidden" name="zip_code" id="postal" value="{{ old('zip_code') }}">
						</div>
						@if($errors->has('zip_code'))
							<div class="error-msg">
								<strong>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
					</div>

					<div class="prefecture-container input-container">
						<p>
							都道府県
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<div class="select-arrow">
							<select name="prefecture" id="prefecture">
							@foreach(config('consts.pref') as $_pref)
							<option value="{{ $_pref }}" {{ old('prefecture', $partner->prefecture) === $_pref ? 'selected' : '' }}>{{ $_pref }}</option>
							@endforeach
							</select>
						</div>
						@if($errors->has('prefecture'))
							<div class="error-msg">
								<strong>{{ $errors->first('prefecture') }}</strong>
							</div>
						@endif
					</div>
				</div>

				<div class="below-address-container">
					<div class="city-container input-container">
						<p>
							市区町村
							<span class="required-label row-label">( 必須 )</span>
						</p>
							<input type="text" name="city" value="{{ old('city', $partner->city) }}">
							@if($errors->has('city'))
								<div class="error-msg">
									<strong>{{ $errors->first('city') }}</strong>
								</div>
							@endif
					</div>

					<div class="building-container input-container">
						<p>
							番地
							<span class="required-label row-label">( 必須 )</span>
						</p>
							<input type="text" name="street" value="{{ old('street', $partner->street) }}">
							@if($errors->has('street'))
								<div class="error-msg">
									<strong>{{ $errors->first('street') }}</strong>
								</div>
							@endif
					</div>
				</div>

				<div class="below-address-container">
					<div class="building-container input-container">
						<p>
							建物
							<span class="optional-label row-label">( 任意 )</span>
						</p>
						<input type="text" name="building" value="{{ old('building', $partner->building) }}">
						@if($errors->has('building'))
							<div class="error-msg">
								<strong>{{ $errors->first('building') }}</strong>
							</div>
						@endif
					</div>
				</div>

				<div class="below-address-container last">
					<div class="tel-container input-container">
						<p>
							電話番号
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<div class="tel-container__wrapper">
							<input type="text" name="tel" id="tel" value="{{ old('tel', $partner->tel) }}" maxlength="11">
						</div>
						@if($errors->has('tel'))
							<div class="error-msg">
								<strong>{{ $errors->first('tel') }}</strong>
							</div>					
						@endif
					</div>
				</div>
			</div>

			<input type="hidden" name="partner_id" value="{{ $partner->id }}">

			<div class="btn-container">
				<button data-impro-button="once" type="button" onclick="submit();">確認</button>
			</div>
		</form>
	</div>
</main>
@endsection
