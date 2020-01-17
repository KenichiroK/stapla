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
			<div class="edit-container">
				@if(!isset($companyUser->invitation_user_id))
				<div class="company-container">
					<div class="section-container">
						<p>企業名</p>
						<input type="hidden" name="company_name" value="{{ $companyUser->company->company_name }}">
						<h4>{{ $companyUser->Company->company_name }}</h4>
					</div>

					<div class="section-container">
						<p>代表者名</p>
						<input type="hidden" name="representive_name" value="{{ $companyUser->Company->representive_name }}">
						<h4>{{ $companyUser->Company->representive_name }}</h4>
					</div>

					<div class="section-container">
						<p>郵便番号</p>
						<input type="hidden" name="zip_code" value="{{ $companyUser->Company->zip_code }}">
						<h4>{{ $companyUser->Company->zip_code }}</h4>
					</div>

					<div class="section-container">
						<p>都道府県</p>
						<input type="hidden" name="address_prefecture" value="{{ $companyUser->Company->address_prefecture }}">
						<h4>
							{{ $companyUser->Company->address_prefecture }}
						</h4>
					</div>

					<div class="section-container">
						<p>市区町村・番地</p>
						<input type="hidden" name="address_city" value="{{ $companyUser->Company->address_city }}">
						<h4>
							{{ $companyUser->Company->address_city }}
						</h4>
					</div>

					<div class="section-container">
						<p>建物名・部屋番号</p>
						<input type="hidden" name="address_building" value="{{ $companyUser->Company->address_building }}">
						<h4>
							{{ $companyUser->Company->address_building }}
						</h4>
					</div>

					<div class="section-container">
						<p>電話番号</p>
						<input type="hidden" name="tel" value="{{ $companyUser->Company->tel }}">
						<h4>{{ $companyUser->Company->tel }}</h4>
					</div>
				</div>
				<input type="hidden" name="is_agree" value="{{ $request->is_agree }}">
				@endif
			</div>

			<div class="edit-container">
				<div class="image-container">
					<div class="imgbox">
						<img id="profile_image_preview" src="{{ $companyUser->picture }}" alt="プレビュー画像">
					</div>
				</div>
				<div class="personal-container">
					<div class="profile-container">
						<div class="section-container">
							<p>名前</p>
							<input type="hidden" name="name" value="{{ $companyUser->name }}">
							<h4>{{ $companyUser->name }}</h4>
						</div>

						<div class="section-container">
							<p>所属部署</p>
							<input type="hidden" name="department" value="{{ $companyUser->department }}">
							<h4>{{ $companyUser->department }}</h4>
						</div>

						<div class="section-container">
							<p>職種</p>
							<input type="hidden" name="occupation" value="{{ $companyUser->occupation }}">
							<h4>{{ $companyUser->occupation }}</h4>
						</div>

						<div class="section-container">
							<p>自己紹介</p>
							<input type="hidden" name="self_introduction" value="{{ $companyUser->self_introduction }}">
							<h4>{!! nl2br(e($companyUser->self_introduction)) !!}</h4>
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
