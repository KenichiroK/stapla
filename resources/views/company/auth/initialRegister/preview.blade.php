<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
	<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/preview.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
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


			{{ $companyUser }}
			<form action="" method="POST">
				<div class="edit-container">
					<div class="personal-container">
						<div class="image-container">
						<img src="/{{ str_replace('public/', 'storage/', $companyUser->picture) }}" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
						</div>
						<!-- <div class="image-container">
							<img src="/images/preview.jpeg" alt="プレビュー画像" id="profile_image_preview" width="140px" height="140px">
						</div> -->

						<div class="profile-container">
							<div class="section-container">
								<p>名前</p>
								<h4>{{ $companyUser->name }}</h4>
							</div>

							<div class="section-container">
								<p>担当</p>
								<h4>{{ $companyUser->department }}</h4>
							</div>

							<div class="section-container">
								<p>自己紹介</p>
								<h4>{{ $companyUser->self_introduction }}</h4>
							</div>
						</div>
					</div>

					<div class="company-container">
						<div class="section-container">
							<p>会社名</p>
							<h4>{{ $company->company_name }}</h4>
						</div>

						<div class="section-container">
							<p>代表者名</p>
							<h4>{{ $company->representive_name }}</h4>
						</div>

						<div class="section-container">
							<p>郵便番号</p>
							<h4>{{ $company->zip_code }}</h4>
						</div>

						<div class="section-container">
							<p>住所</p>
							<h4>
								{{ $company->address_prefecture }}
								{{ $company->address_city }}
								{{ $company->address_building }}
							</h4>
						</div>

						<div class="section-container">
							<p>電話番号</p>
							<h4>{{ $company->tel }}</h4>
						</div>
					</div>
				</div>
			</form>

			<div class="btn-container">
				<button type="button"><a type="button" href="/company/registerInfo">戻る</a></button>
				<button type="submit"><a type="submit" href="/company/done">登録</a></button>
			</div>
        </div>
    </main>

    <footer>
        <span>ご利用規約</span>
        <span>プライバシーポリシー</span>
	</footer>
	
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
</body>
</html>
