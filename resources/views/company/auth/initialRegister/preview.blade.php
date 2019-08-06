<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
	<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/preview.css') }}">
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
				<h3>入力内容確認</h3>
			</div>

			<form action="/company/register/preview/previewStore" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="">
				<div class="edit-container">
					<div class="personal-container">
						<div class="image-container">
							@if (isset($request->picture))
								{{ $request->picture }}	<!--  仮で表示-->
								<div class="imgbox">
									<img src="/{{ $request->picture }}" alt="プレビュー画像" width="140px" height="140px" style="display: none;">
								</div>
							@else
								<div class="imgbox">
									<img src="/{{ str_replace('public/', 'storage/', 'images/preview.jpeg') }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
								</div>
							@endif
							<label for="picture">
								<!-- 画像をアップロード -->
								<input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" style="display: none;" onchange="setPreview(this)" style="display: none;">
							</label>
						</div>
					

						<div class="profile-container">
							<div class="section-container">
								<p>名前</p>
								<input type="hidden" name="name" value="{{ old('name', $request->name) }}">
								<h4>{{ $request->name }}</h4>
							</div>

							<div class="section-container">
								<p>担当</p>
								<input type="hidden" name="department" value="{{ old('department', $request->department) }}">
								<h4>{{ $request->department }}</h4>
							</div>

							<div class="section-container">
								<p>自己紹介</p>
								<input type="hidden" name="self_introduction" value="{{ old('self_introduction', $request->self_introduction) }}">
								<h4>{{ $request->self_introduction }}</h4>
							</div>
						</div>
					</div>

					<div class="company-container">
						<div class="section-container">
							<p>会社名</p>
							<input type="hidden" name="company_name" value="{{ old('company_name', $request->company_name) }}">
							<h4>{{ $request->company_name }}</h4>
						</div>

						<div class="section-container">
							<p>代表者名</p>
							<input type="hidden" name="representive_name" value="{{ old('representive_name', $request->representive_name) }}">
							<h4>{{ $request->representive_name }}</h4>
						</div>

						<div class="section-container">
							<p>郵便番号</p>
							<input type="hidden" name="zip_code" value="{{ old('zip_code', $request->zip_code) }}">
							<h4>{{ $request->zip_code }}</h4>
						</div>

						<div class="section-container">
							<p>住所</p>
							<input type="hidden" name="address_prefecture" value="{{ old('address_prefecture', $request->address_prefecture) }}">
							<input type="hidden" name="address_city" value="{{ old('address_city', $request->address_city) }}">
							<input type="hidden" name="address_building" value="{{ old('address_building', $request->address_building) }}">
							<h4>
								{{ $request->address_prefecture }}
								{{ $request->address_city }}
								{{ $request->address_building }}
							</h4>
						</div>

						<div class="section-container">
							<p>電話番号</p>
							<input type="hidden" name="tel" value="{{ old('tel', $request->tel) }}">
							<h4>{{ $request->tel }}</h4>
						</div>
					</div>
				</div>
				<div class="btn-container">
				<button type="button"><a type="button" href="/company/register/intialRegistration">戻る</a></button>
				<button type="submit">登録</button>
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
