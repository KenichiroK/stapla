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
	</script>
</head>
<body>
    <header>
        <div class="logo_container">
            <p class="logo">impro</p>
        </div>
    </header>

    <main>
        <div class="main-wrapper">
			<div class="title-container">
				<h3>企業情報登録</h3>
			</div>

			<form action="/company/register/initialRegistration" method="POST" enctype="multipart/form-data">
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
								<input type="text" name="zip_code" value="{{ old('zip_code') }}">
								<span class="hyphen"><hr></span>
								<input type="text" name="zip_code" value="{{ old('zip_code') }}">
							</div>	
							@if ($errors->has('zip_code'))
								<div class="error-msg">
									<strong>{{ $errors->first('zip_code') }}</strong>
								</div>
							@endif
						</div>
						<div class="input-container prefecture-container">
							<p>都道府県</p>
								<!-- <input type="text" name="address_prefecture" value="{{ old('address_prefecture') }}">
							@if ($errors->has('address_prefecture'))
								<div class="error-msg">
									<strong>{{ $errors->first('address_prefecture') }}</strong>
								</div>
							@endif -->
							<div class="select-arrow">
								<select name="address_prefecture" id="prefecture">
								<option value=""></option>
								</select>
							</div>
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
						<div class="input-container">
							<p>電話番号</p>
								<input type="text" name="tel" value="{{ old('tel') }}">
								@if ($errors->has('tel'))
									<div class="error-msg">
										<strong>{{ $errors->first('tel') }}</strong>
									</div>
								@endif
						</div>
					</div>
				</div>

				<div class="edit-container-personal">
					<div class="image-container">
						<div class="imgbox">
							<img id="profile_image_preview" src="../../../images/upload4.png" alt="プレビュー画像">
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
							<p>部署</p>
								<input type="text" name="name" value="">
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
