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

function setPostal(){
	const postal_front = document.getElementById('postal_front').value;
	const postal_back = document.getElementById('postal_back').value;
	const postal = document.getElementById('postal');
	postal.value = postal_front + postal_back;
}
</script>
@endsection

@section('content')
<?php
$pref = array(
	'',
    '北海道',
    '青森県',
    '岩手県',
    '宮城県',
    '秋田県',
    '山形県',
    '福島県',
    '茨城県',
    '栃木県',
    '群馬県',
    '埼玉県',
    '千葉県',
    '東京都',
    '神奈川県',
    '新潟県',
    '富山県',
    '石川県',
    '福井県',
    '山梨県',
    '長野県',
    '岐阜県',
    '静岡県',
    '愛知県',
    '三重県',
    '滋賀県',
    '京都府',
    '大阪府',
    '兵庫県',
    '奈良県',
    '和歌山県',
    '鳥取県',
    '島根県',
    '岡山県',
    '広島県',
    '山口県',
    '徳島県',
    '香川県',
    '愛媛県',
    '高知県',
    '福岡県',
    '佐賀県',
    '長崎県',
    '熊本県',
    '大分県',
    '宮崎県',
    '鹿児島県',
    '沖縄県'
);
?>
	
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

		<form action="{{ route('partner.register.intialRegistrationPost') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="edit-container top">
				<div class="image-container">
					<div class="imgbox">
						<img id="profile_image_preview" src="{{ env('AWS_URL') }}/common/upload4.png" alt="プレビュー画像">
					</div> 
					<label for="picture">
						画像をアップロード
						<input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" onchange="setPreview(this)" style="display: none;">
					</label>
				</div>
				<div class="profile-container">

					<div class="input-container">
						<p>
							名前・ニックネーム
							<span class="required-label row-label">( 必須 )</span>
						</p>
						<input type="text" name="name" value="{{ old('name') }}">								
						@if ($errors->has('name'))
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
						<input type="text" name="occupations" value="{{ old('occupations') }}" placeholder="例）UIデザイナー、フロントエンドエンジニア、etc">	
						@if ($errors->has('occupations'))
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
						<textarea type="text" name="introduction" cols="30" rows="10">{{ old('introduction') }}</textarea>
						@if ($errors->has('introduction'))
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
								<input type="text" name="zip_code_front" id="postal_front" value="{{ old('zip_code_front') }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
								<span class="hyphen"><hr></span>
								<input type="text" name="zip_code_back" id="postal_back" value="{{ old('zip_code_back') }}" maxlength="4" onchange="setPostal()">
								<input type="hidden" name="zip_code" id="postal" value="{{ old('zip_code') }}">
							</div>
							@if ($errors->has('zip_code'))
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
										@foreach($pref as $_pref)
										<option value="{{ $_pref }}" {{ (old('prefecture') === $_pref) ? 'selected' : '' }}>{{ $_pref }}</option>
										@endforeach
								</select>
							</div>
							@if ($errors->has('prefecture'))
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
								<input type="text" name="city" value="{{ old('city') }}">
								@if ($errors->has('city'))
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
								<input type="text" name="street" value="{{ old('street') }}">
								@if ($errors->has('street'))
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
							<input type="text" name="building" value="{{ old('building') }}">
							@if ($errors->has('building'))
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
								<input type="text" name="tel" id="tel" value="{{ old('tel') }}" maxlength="11">
							</div>
							@if ($errors->has('tel'))
								<div class="error-msg">
									<strong>{{ $errors->first('tel') }}</strong>
								</div>					
							@endif
						</div>
					</div>


			</div>

			<div class="btn-container">
				<button type="button" onclick="submit();">確認</button>
			</div>
		</form>
	</div>
</main>

<footer>
	<span>ご利用規約</span>
	<span>プライバシーポリシー</span>
</footer>
@endsection
