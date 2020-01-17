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
			<h3>入力内容確認</h3>
		</div>

		<form action="{{ route('company.register.preview.register') }}" method="POST" enctype="multipart/form-data">
		@csrf
			<div class="edit-container">
				<div class="company-container">
					<div class="profile-container">
						<div class="section-container">
							<p>名前</p>
							<input type="hidden" name="name" value="{{ old('name', $companyUser->name) }}">
							<h4>{{ $companyUser->name }}</h4>
						</div>

						<div class="section-container">
							<p>所属部署</p>
							<input type="hidden" name="department" value="{{ old('department', $companyUser->department) }}">
							<h4>{{ $companyUser->department }}</h4>
						</div>

						<div class="section-container">
							<p>職種</p>
							<input type="hidden" name="occupation" value="{{ old('occupation', $companyUser->occupation) }}">
							<h4>{{ $companyUser->occupation }}</h4>
						</div>

						<div class="section-container">
							<p>自己紹介</p>
							<input type="hidden" name="self_introduction" value="{{ old('self_introduction', $companyUser->self_introduction) }}">
							<h4>{!! nl2br(e($companyUser->self_introduction)) !!}</h4>
						</div>
					</div>
				</div>

				@if(!isset($companyUser->invitation_user_id))
				<div class="company-container">
					<div class="section-container">
						<p>会社名</p>
						<input type="hidden" name="company_name" value="{{ old('company_name', $companyUser->company->company_name) }}">
						<h4>{{ $companyUser->Company->company_name }}</h4>
					</div>

					<div class="section-container">
						<p>代表者名</p>
						<input type="hidden" name="representive_name" value="{{ old('representive_name', $companyUser->Company->representive_name) }}">
						<h4>{{ $companyUser->Company->representive_name }}</h4>
					</div>

					<div class="section-container">
						<p>郵便番号</p>
						<input type="hidden" name="zip_code" value="{{ old('zip_code', $companyUser->Company->zip_code) }}">
						<h4>{{ $companyUser->Company->zip_code }}</h4>
					</div>

					<div class="section-container">
						<p>住所</p>
						<input type="hidden" name="address_prefecture" value="{{ old('address_prefecture', $companyUser->Company->address_prefecture) }}">
						<input type="hidden" name="address_city" value="{{ old('address_city', $companyUser->Company->address_city) }}">
						<input type="hidden" name="address_building" value="{{ old('address_building', $companyUser->Company->address_building) }}">
						<h4>
							{{ $companyUser->Company->address_prefecture }}
							{{ $companyUser->Company->address_city }}
							{{ $companyUser->Company->address_building }}
						</h4>
					</div>

					<div class="section-container">
						<p>電話番号</p>
						<input type="hidden" name="tel" value="{{ old('tel', $companyUser->Company->tel) }}">
						<h4>{{ $companyUser->Company->tel }}</h4>
					</div>
				</div>
				<input type="hidden" name="is_agree" value="{{ $request->is_agree }}">
				@endif
			</div>
			<input type="hidden" name="companyUser_id" value="{{ $companyUser->id }}">

			<div class="btn-container">
				<a href="{{ route('company.register.personal.create', [ 'companyUser_id' => $companyUser->id ]) }}">入力し直す</a>
				<button type="submit">登録</button>
			</div>
		</form>
	</div>
</main>
@endsection
