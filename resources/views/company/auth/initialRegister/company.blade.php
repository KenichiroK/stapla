<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
	<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/company.css') }}">
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
				<h3>会社情報登録</h3>
			</div>

			<form action="" method="POST">
				<div class="edit-container">
					<div class="top-container">
						<div class="input-container">
							<p>会社名</p>
							<input type="text" name="company_name" value="{{ old('company_name') }}">
						</div>
						<div class="input-container">
							<p>代表者名</p>
							<input type="text" name="representive_name" value="{{ old('representive_name') }}">
						</div>
					</div>

					<div class="middle-container">
						<div class="input-container">
							<p>郵便番号</p>
							<input type="tel" name="zip_code" value="{{ old('zip_code') }}">
						</div>
						<div class="input-container">
							<p>都道府県</p>
							<input type="text" name="address_prefecture" value="{{ old('address_prefecture') }}">
						</div>
					</div>

					<div class="bottom-container">
						<div class="input-container">
							<p>市区町村・番地</p>
							<input type="text" name="address_city" value="{{ old('address_city') }}">
						</div>
						<div class="input-container">
							<p>建物名・部屋番号</p>
							<input type="text" name="address_building" value="{{ old('address_building') }}">
						</div>
					</div>
				</div>

				<div class="btn-container">
					<button type="button">戻る</button>
					<button type="button" onclick="submit();">確認</button>
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
