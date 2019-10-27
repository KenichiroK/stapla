<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Impro</title>
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/personal.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
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

const setTel = () => {
  const tel_front = document.getElementById('tel_front').value;
  const tel_middle = document.getElementById('tel_middle').value;
  const tel_back = document.getElementById('tel_back').value;
  const tel = document.getElementById('tel');
  tel.value = tel_front + tel_middle + tel_back;
}
</script>
</head>
<?php
$pref = array(
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
<body>
    <header>
        <div class="logo_container">
            <p class="logo">impro</p>
        </div>
    </header>

	<!-- 最初に登録するユーザー($companyUserにcompany_idなし)か、招待されて登録するユーザー($companyUserにcompany_idあり)かの判定 -->
	<!-- 最初に登録するユーザー -->
	@if(isset($companyUser->company_id))
	<main>
        <div class="main-wrapper">
			@if(count($errors) > 0)
				<div class="error-container">
					<p>入力に問題があります。再入力して下さい。</p>
				</div>
			@endif

			<div class="title-container">
				<h3>個人情報登録</h3>
			</div>

			<form action="{{ route('company.register.personal.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="edit-container-personal edit-container">
					<div class="image-container">
						<div class="imgbox">
							<img id="profile_image_preview" src="{{ asset('images/upload4.png') }}" alt="プレビュー画像">
						</div> 
						<label for="picture">
							画像をアップロード
							<input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" onchange="setPreview(this)" style="display: none;">
						</label>
					</div>
					<div class="profile-container">
						<div class="input-container">
							<p>名前</p>
							<input type="text" name="name" value="{{ old('name') }}">								
							@if ($errors->has('name'))
								<div class="error-msg">
									<strong>{{ $errors->first('name') }}</strong>
								</div>
							@endif
						</div>

						<div class="input-container">
							<p>所属部署</p>
							<input type="text" name="department" value="{{ old('department') }}">
							@if ($errors->has('department'))
								<div class="error-msg">
									<strong>{{ $errors->first('department') }}</strong>
								</div>
							@endif
						</div>

						<div class="input-container">
							<p>職種</p>
							<input type="text" name="occupation" value="{{ old('occupation') }}">
						</div>

						<div class="input-container last">
							<p>自己紹介</p>
							<textarea type="text" name="self_introduction" cols="30" rows="10">{{ old('self_introduction') }}</textarea>
							@if ($errors->has('self_introduction'))
								<div class="error-msg">
									<strong>{{ $errors->first('self_introduction') }}</strong>
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

	<!-- 最初に登録するユーザーか、招待されて登録するユーザーかの判定 -->
	<!-- 招待されて登録するユーザー -->
	@else

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

			<form action="{{ route('company.register.company-and-personal.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div class="edit-container-company">
					<div class="top-container">
						<div class="input-container linefirst-input">
							<p>会社名</p>
							<input type="text" name="company_name" value="{{ old('company_name') }}">
							@if ($errors->has('company_name'))
								<div class="error-msg">
									<strong>{{ $errors->first('company_name') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container">
							<p>代表者名</p>
							<input type="text" name="representive_name" value="{{ old('representive_name') }}">
							@if ($errors->has('representive_name'))
								<div class="error-msg">
									<strong>{{ $errors->first('representive_name') }}</strong>
								</div>
							@endif
						</div>
					</div>

					<div class="middle-container">
						<div class="input-container zipcode-container">
							<p>郵便番号</p>
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
						<div class="input-container prefecture-container">
							<p>都道府県</p>
							<div class="select-arrow">
								<select name="address_prefecture" id="prefecture">
									<option disabled="disabled" selected></option>
									@foreach($pref as $_pref)
										<option value="{{ $_pref }}" {{ (old('address_prefecture') === $_pref) ? 'selected' : '' }}>{{ $_pref }}</option>
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
							<p>市区町村・番地</p>
							<input type="text" name="address_city" value="{{ old('address_city') }}">
							@if ($errors->has('address_city'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_city') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container">
							<p>建物名・部屋番号</p>
							<input type="text" name="address_building" value="{{ old('address_building') }}">
							@if ($errors->has('address_building'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_building') }}</strong>
								</div>
							@endif
						</div>
					</div>
					<div class="bottom-container last">
						<div class="tel-container input-container">
							<p>電話番号</p>
								<div class="tel-container__wrapper">
									<input type="text" name="tel_front" id="tel_front" value="{{ old('tel_front') }}" maxlength="4" onchange="setTel()">
									<span class="hyphen"><hr></span>
									<input type="text" name="tel_middle" id="tel_middle" value="{{ old('tel_middle') }}" maxlength="4" onchange="setTel()">
									<span class="hyphen"><hr></span>
									<input type="text" name="tel_back" id="tel_back" value="{{ old('tel_back') }}" maxlength="4" onchange="setTel()">
									<input type="hidden" name="tel" id="tel" value="{{ old('tel') }}">
								</div>
								@if ($errors->has('tel'))
									<div class="error-msg">
										<strong>{{ $errors->first('tel') }}</strong>
									</div>
								@endif
						</div>
					</div>
				</div>

				<div class="edit-container-personal edit-container">
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
							<p>名前</p>
							<input type="text" name="name" value="{{ old('name') }}">								
							@if ($errors->has('name'))
								<div class="error-msg">
									<strong>{{ $errors->first('name') }}</strong>
								</div>
							@endif
						</div>

						<div class="input-container">
							<p>担当</p>
							<input type="text" name="department" value="{{ old('department') }}">
							@if ($errors->has('department'))
								<div class="error-msg">
									<strong>{{ $errors->first('department') }}</strong>
								</div>
							@endif
						</div>

						<div class="input-container">
							<p>職種</p>
							<input type="text" name="occupation" value="{{ old('occupation') }}">
						</div>

						<div class="input-container last">
							<p>自己紹介</p>
							<textarea type="text" name="self_introduction" cols="30" rows="10">{{ old('self_introduction') }}</textarea>
							@if ($errors->has('self_introduction'))
								<div class="error-msg">
									<strong>{{ $errors->first('self_introduction') }}</strong>
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
	@endif

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
    </footer>
</body>
</html>
