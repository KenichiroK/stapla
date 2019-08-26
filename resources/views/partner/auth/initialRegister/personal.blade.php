<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
	<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/personal.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>

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
				<h3>プロフィール登録</h3>
			</div>

			<form action="{{ url('partner/register/initial/personal') }}" method="POST">
				@csrf
				<div class="profile-container">

					<div class="name-container">
						<p>名前</p>
							<input type="text" name="name" value="{{ old('name') }}">								
							@if ($errors->has('name'))
								<div>
									<strong style='color: #e3342f;'>{{ $errors->first('name') }}</strong>
								</div>
							@endif
					</div>

					<div class="above-address-container">
						<div class="zipcode-container">
							<p>郵便番号</p>
								<input type="text" name="zip_code" value="{{ old('zip_code') }}">
								@if ($errors->has('zip_code'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('zip_code') }}</strong>
									</div>
								@endif
						</div>

						<div class="prefecture-container">
							<p>都道府県</p>
							<div class="select-arrow">
								<select name="prefecture" id="prefecture">
										@foreach($pref as $_pref)
										<option value="{{ $_pref }}">{{ $_pref }}</option>
										@endforeach
								</select>
							</div>
							@if ($errors->has('prefecture'))
								<div>
									<strong style='color: #e3342f;'>{{ $errors->first('prefecture') }}</strong>
								</div>
							@endif
						</div>
					</div>

					<div class="below-address-container">
						<div class="city-container">
							<p>市区町村区</p>
								<input type="text" name="city" value="{{ old('city') }}">
								@if ($errors->has('city'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('city') }}</strong>
									</div>
								@endif
						</div>

						<div class="building-container">
							<p>番地</p>
								<input type="text" name="street" value="{{ old('street') }}">
								@if ($errors->has('street'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('street') }}</strong>
									</div>
								@endif
						</div>
					</div>

					<div class="below-address-container">
						<div class="building-container">
							<p>建物</p>
							<input type="text" name="building" value="{{ old('building') }}">
							@if ($errors->has('building'))
								<div>
									<strong style='color: #e3342f;'>{{ $errors->first('building') }}</strong>
								</div>
							@endif
						</div>

						<div class="building-container">
							<p>電話番号</p>
							<input type="text" name="tel" value="{{ old('tel') }}">
							@if ($errors->has('tel'))
								<div>
									<strong style='color: #e3342f;'>{{ $errors->first('tel') }}</strong>
								</div>					
							@endif
								<!-- 近日中に入力箇所３つに分けての電話番号を入力する実装のために残してあります。 -->
								<!-- <input type="text" name="tel" value="{{ old('tel') }}" placeholder="">
									<span class="hyphen">
										<hr>
									</span>
								<input type="text">
									<span class="hyphen">
										<hr>
									</span>
								<input type="text"> -->
						</div>
					</div>

					<div class="below-address-container">
						<div class="city-container">
							<p>自己紹介</p>
							<textarea type="text" name="introduction" cols="30" rows="10">{{ old('introduction') }}</textarea>
						</div>
					</div>

					
				</div>

				<div class="btn-container">
					<button type="submit">確認</button>
				</div>
			</form>
        </div>
    </main>

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
    </footer>
</body>
</html>
