 @extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('preview');

  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    impro
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
								<li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
								<li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
                <li>
					<form method="POST" action="{{ route('company.logout') }}">
						@csrf
						<button type="submit">ログアウト</button>
					</form>
				</li>
            </ul>
        </aside>
    </div>
</div>
@endsection


@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>設定</h3>
	</div>
	<div class="menu-container">
		<ul>
			<li><a href="/company/setting/general" class="isActive">会社基本情報設定</a></li>
			<li><a href="/company/setting/companyElse">会社その他の設定</a></li>
			<li><a href="/company/setting/userSetting">会社担当者設定</a></li>
			<li><a href="/company/setting/account">アカウント設定</a></li>
			<li><a href="/company/setting/personalInfo">個人情報の設定</a></li>
		</ul>
	</div>
	<div class=profile-container>
		<form action="{{ url('/company/setting/general') }}" method="POST">
		@csrf
			<div class="top-area">
				<div class="name-container">
					<p>会社名</p>
					@if($company)
						<input class="top-input input" type="" name="company_name" value="{{ old('company_name', $company->company_name) }}" placeholder="">
					@else
						<input class="top-input input" type="" name="company_name" value="{{ old('company_name') }}" placeholder="">
					@endif
					@if ($errors->has('company_name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('company_name') }}</strong>
						</div>
					@endif
				</div>
				<div class="name-container">
					<p>代表者名</p>
					@if($company)
						<input class="top-input input" type="text" name="representive_name" value="{{ old('representive_name', $company->representive_name) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="representive_name" value="{{ old('representive_name') }}" placeholder="">
					@endif
					@if ($errors->has('representive_name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('representive_name') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					<div class="zipcode-container__wrapper">
						@if($company)
							<input class="top-input input" type="text" name="zip_code" value="{{ old('zip_code', $company->zip_code) }}" placeholder="">
							<span class="hyphen"><i class="fa fa-minus" aria-hidden="true"></i></span>
							<input type="text">
						@else
							<input class="top-input input" type="text" name="zip_code" value="{{ old('zip_code') }}" placeholder="">
							-<input type="text">
						@endif
						@if ($errors->has('zip_code'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
					</div>
				</div>
	
				<div class="prefecture-container">
					<p>都道府県</p>
					@if($company)
						<input class="top-input input" type="text" name="address_prefecture" value="{{ old('address_prefecture', $company->address_prefecture) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="address_prefecture" value="{{ old('address_prefecture') }}" placeholder="">
					@endif
					@if ($errors->has('address_prefecture'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_prefecture') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="below-address-container">
				<div class="city-container">
					<p>市区町村・番地</p>
					@if($company)
						<input class="top-input input" type="text" name="address_city" value="{{ old('address_city', $company->address_city) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="address_city" value="{{ old('address_city') }}" placeholder="">
					@endif
					@if ($errors->has('address_city'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_city') }}</strong>
						</div>
					@endif
				</div>
	
				<div class="building-container">
					<p>建物名・部屋番号</p>
					@if ($company)
						<input type="text" name="address_building" value="{{ old('address_building', $company->address_building) }}">
					@else
						<input type="text" name="address_building" value="{{ old('address_building') }}">
					@endif
					@if ($errors->has('address_building'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_building') }}</strong>
						</div>
					@endif
				</div>
			</div>
		</form>
	</div>
	<div class="btn-container">
		<button type="submit">設定</button>
	</div>
</div>
@endsection
