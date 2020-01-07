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

		<!-- 最初に登録するユーザー($requestにcompany_nameあり)か、招待されて登録するユーザー($requestにcompany_nameなし)かの判定 -->
		<!-- 最初に登録するユーザー -->
		@if(isset($request->company_name))
		<form action="{{ route('company.register.company-preview.store') }}" method="POST" enctype="multipart/form-data">
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
							<p>所属部署</p>
							<input type="hidden" name="department" value="{{ old('department', $request->department) }}">
							<h4>{{ $request->department }}</h4>
						</div>

						<div class="section-container">
							<p>職種</p>
							<input type="hidden" name="occupation" value="{{ old('occupation', $request->occupation) }}">
							<h4>{{ $request->occupation }}</h4>
						</div>

						<div class="section-container">
							<p>自己紹介</p>
							<input type="hidden" name="self_introduction" value="{{ old('self_introduction', $request->self_introduction) }}">
							<h4>{!! nl2br(e($request->self_introduction)) !!}</h4>
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
				<input type="hidden" name="picture" value="{{ $urlPicture }}">
			</div>
			<div class="btn-container">
				<button data-impro-button="once" type="button" onclick="submit()"><a type="button" href="{{ route('company.register.personal.create') }}">戻る</a></button>
				<button type="submit">登録</button>
			</div>
		</form>

		<!-- 招待されて登録するユーザー -->
		@else

		<form action="{{ route('company.register.preview.store') }}" method="POST" enctype="multipart/form-data">
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
							<p>所属部署</p>
							<input type="hidden" name="department" value="{{ old('department', $request->department) }}">
							<h4>{{ $request->department }}</h4>
						</div>

						<div class="section-container">
							<p>職種</p>
							<input type="hidden" name="occupation" value="{{ old('occupation', $request->occupation) }}">
							<h4>{{ $request->occupation }}</h4>
						</div>

						<div class="section-container">
							<p>自己紹介</p>
							<input type="hidden" name="self_introduction" value="{{ old('self_introduction', $request->self_introduction) }}">
							<h4>{!! nl2br(e($request->self_introduction)) !!}</h4>
						</div>
					</div>
				</div>
				<input type="hidden" name="picture" value="{{ $urlPicture }}">
				
			</div>
			<div class="btn-container">
				<button data-impro-button="once" type="button" onclick="submit()"><a type="button" href="{{ route('company.register.personal.create') }}">戻る</a></button>
				<button type="submit">登録</button>
			</div>
		</form>
		@endif
	</div>
</main>

<footer>
	<span>ご利用規約</span>
	<span>プライバシーポリシー</span>
</footer>
@endsection
