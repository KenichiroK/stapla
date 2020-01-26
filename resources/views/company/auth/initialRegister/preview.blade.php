@extends('index')
    
@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/preview.css') }}">
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
			<h3>プレビュー</h3>
		</div>

		<form action="{{ route('company.register.preview.previewStore') }}" method="POST" enctype="multipart/form-data">
		@csrf
			@if(!isset($companyUser->invitation_user_id))
			<div class="edit-container">
				<div class="company-container">
					<div class="section-container">
						<p class="profile-subject">企業名</p>
						<p>{{ $companyUser->Company->company_name }}</p>
						<input type="hidden" name="company_name" value="{{ $companyUser->company->company_name }}">
					</div>

					<div class="section-container">
						<p class="profile-subject">代表者名</p>
						<p>{{ $companyUser->Company->representive_name }}</p>
						<input type="hidden" name="representive_name" value="{{ $companyUser->Company->representive_name }}">
					</div>

					<div class="section-container">
						<p class="profile-subject">郵便番号</p>
						<p>{{ mb_substr($companyUser->Company->zip_code, 0, 3) }}-{{ mb_substr($companyUser->Company->zip_code, 3) }}</p>
						<input type="hidden" name="zip_code" value="{{ $companyUser->Company->zip_code }}">
					</div>

					<div class="section-container">
						<p class="profile-subject">都道府県</p>
						<p>{{ $companyUser->Company->address_prefecture }}</p>
						<input type="hidden" name="address_prefecture" value="{{ $companyUser->Company->address_prefecture }}">
					</div>

					<div class="section-container">
						<p class="profile-subject">市区町村・番地</p>
						<p>{{ $companyUser->Company->address_city }}</p>
						<input type="hidden" name="address_city" value="{{ $companyUser->Company->address_city }}">
					</div>

					<div class="section-container">
						<p>
							<p class="profile-subject">建物名・部屋番号</p>
							<p>{{ $companyUser->Company->address_building }}</p>
						</p>
						<input type="hidden" name="address_building" value="{{ $companyUser->Company->address_building }}">
					</div>

					<div class="section-container">
						<p class="profile-subject">電話番号</p>
						<p>{{ $companyUser->Company->tel }}</p>
						<input type="hidden" name="tel" value="{{ $companyUser->Company->tel }}">
					</div>
				</div>
				<input type="hidden" name="is_agree" value="{{ $request->is_agree }}">
			</div>
			@endif

			<div class="edit-container">
				<div class="image-container">
					<div class="imgbox">
						<img id="profile_image_preview" src="{{ $companyUser->picture }}" alt="プレビュー画像">
					</div>
				</div>
				<div class="personal-container">
					<div class="profile-container">
						<div class="section-container">
							<p class="profile-subject">名前</p>
							<p>{{ $companyUser->name }}</p>
							<input type="hidden" name="name" value="{{ $companyUser->name }}">
						</div>

						<div class="section-container">
							<p class="profile-subject">所属部署</p>
							<p>{{ $companyUser->department }}</p>
							<input type="hidden" name="department" value="{{ $companyUser->department }}">
						</div>

						<div class="section-container">
							<p class="profile-subject">職種</p>
							<p>{{ $companyUser->occupation }}</p>
							<input type="hidden" name="occupation" value="{{ $companyUser->occupation }}">
						</div>

						<div class="section-container">
							<p class="profile-subject">自己紹介</p>
							<p>{{ $companyUser->self_introduction }}</p>
							<input type="hidden" name="self_introduction" value="{{ $companyUser->self_introduction }}">
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="companyUser_id" value="{{ $companyUser->id }}">

			<div class="btn-container">
				<a href="{{ route('company.register.personal.create', [ 'companyUser_id' => $companyUser->id ]) }}">入力し直す</a>
				<button class="button" type="submit">この内容で登録</button>
			</div>
		</form>
	</div>
</main>
@endsection
