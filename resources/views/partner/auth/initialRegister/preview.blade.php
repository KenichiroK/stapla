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

			<form action="/partner/register/preview/previewStore" method="POST">
				@csrf
				<input type="hidden" name="">
				<div class="edit-container">

					<div class="company-container">
						<div class="profile-container">
							<div class="section-container">
								<p>名前</p>
								<input type="hidden" name="name" value="{{ old('name', $request->name) }}">
								<h4>{{ $request->name }}</h4>
							</div>

							<div class="section-container">
								<p>職種</p>
								<input type="hidden" name="occupations" value="{{ old('occupations', $request->occupations) }}">
								<h4>{{ $request->occupations }}</h4>
							</div>

							<div class="section-container">
								<p>プロフィールメッセージ</p>
								<input type="hidden" name="introduction" value="{{ old('introduction', $request->introduction) }}">
								<h4>{{ $request->introduction }}</h4>
							</div>

                            <div class="section-container">
                                <p>郵便番号</p>
                                <input type="hidden" name="zip_code" value="{{ old('zip_code', $request->zip_code) }}">
                                <h4>{{ $request->zip_code }}</h4>
                            </div>

                            <div class="section-container">
                                <p>住所</p>
                                <input type="hidden" name="prefecture" value="{{ old('prefecture', $request->prefecture) }}">
                                <input type="hidden" name="city" value="{{ old('city', $request->city) }}">
                                <input type="hidden" name="street" value="{{ old('street', $request->street) }}">
                                <input type="hidden" name="building" value="{{ old('building', $request->building) }}">
                                <h4>
                                    {{ $request->prefecture }}
                                    {{ $request->city }}
                                    {{ $request->street }}
                                    {{ $request->building }}
                                </h4>
                            </div>

                            <div class="section-container">
                                <p>電話番号</p>
                                <input type="hidden" name="tel" value="{{ old('tel', $request->tel) }}">
                                <h4>{{ $request->tel }}</h4>
                            </div>

							<div class="section-container">
								<p>自己紹介</p>
								<input type="hidden" name="introduction" value="{{ old('introduction', $request->introduction) }}">
								<h4>{{ $request->introduction }}</h4>
							</div>
                            <input type="hidden" name="company_id" value="{{ $request->company_id }}">
						</div>
					</div>
				</div>
				<div class="btn-container">
				<button type="button"><a type="button" href="/partner/register/initialRegistration">戻る</a></button>
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
