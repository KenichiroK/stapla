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

		<form action="{{ route('partner.register.preview.previewStore') }}" method="POST" enctype="multipart/form-data">
		@csrf
			@if(!isset($companyUser->invitation_user_id))
			<div class="edit-container">
				<div class="company-container">
					<div class="section-container">
						<p>
							<span class="profile-subject">企業名　　　　</span>
							<span>{{ $companyUser->Company->company_name }}</span>
						</p>
						<input type="hidden" name="company_name" value="{{ $companyUser->company->company_name }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">代表者名　　　</span>
							<span>{{ $companyUser->Company->representive_name }}</span>
						</p>
						<input type="hidden" name="representive_name" value="{{ $companyUser->Company->representive_name }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">郵便番号　　　</span>
							<span>{{ $companyUser->Company->zip_code }}</span>
						</p>
						<input type="hidden" name="zip_code" value="{{ $companyUser->Company->zip_code }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">都道府県　　　</span>
							<span>{{ $companyUser->Company->address_prefecture }}</span>
						</p>
						<input type="hidden" name="address_prefecture" value="{{ $companyUser->Company->address_prefecture }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">市区町村・番地</span>
							<span>{{ $companyUser->Company->address_city }}</span>
						</p>
						<input type="hidden" name="address_city" value="{{ $companyUser->Company->address_city }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">建物名・部屋番号</span>
							<span>{{ $companyUser->Company->address_building }}</span>
						</p>
						<input type="hidden" name="address_building" value="{{ $companyUser->Company->address_building }}">
					</div>

					<div class="section-container">
						<p>
							<span class="profile-subject">電話番号　　　</span>
							<span>{{ $companyUser->Company->tel }}</span>
						</p>
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
							<p>
								<span class="profile-subject">名前　　</span>
								<span>{{ $companyUser->name }}</span>
							</p>
							<input type="hidden" name="name" value="{{ $companyUser->name }}">
						</div>

						<div class="section-container">
							<p>
								<span class="profile-subject">所属部署</span>
								<span>{{ $companyUser->department }}</span>
							</p>
							<input type="hidden" name="department" value="{{ $companyUser->department }}">
						</div>

						<div class="section-container">
							<p>
								<span class="profile-subject">職種　　</span>
								<span>{{ $companyUser->occupation }}</span>
							</p>
							<input type="hidden" name="occupation" value="{{ $companyUser->occupation }}">
						</div>

						<div class="section-container">
							<p>
								<span class="profile-subject">自己紹介</span>
								<span>{{ $companyUser->occupation }}</span>
							</p>
							<input type="hidden" name="self_introduction" value="{{ $companyUser->self_introduction }}">
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="companyUser_id" value="{{ $companyUser->id }}">

			<div class="btn-container">
				<a href="{{ route('company.register.personal.create', [ 'companyUser_id' => $companyUser->id ]) }}">入力し直す</a>
				<button type="submit">この内容で登録</button>
			</div>
		</form>
	</div>
</main>
@endsection
