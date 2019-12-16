 @extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    @if (session('completed'))
    <div class="complete-container">
        <p>{{ session('completed') }}</p>
    </div>
    @endif

    @if(count($errors) > 0)
    <div class="error-container">
        <p>入力に問題があります。再入力して下さい。</p>
    </div>
    @endif
    
	<div class="title-container">
		<h3>設定</h3>
	</div>
	<div class="menu-container">
		<ul>
			<li><a href="{{ route('company.setting.general.create') }}" class="isActive">会社基本情報設定</a></li>
			<li><a href="{{ route('company.setting.userSetting.create') }}">会社担当者設定</a></li>
			<li><a href="{{ route('company.setting.personalInfo.create') }}">個人情報の設定</a></li>
			<li><a href="{{ route('company.setting.email.create') }}">メールアドレスの設定</a></li>
		</ul>
	</div>
	<div class="profile-container white-bg-container">
		<form action="{{ route('company.setting.general.update') }}" method="POST">
		@csrf
			<div class="top-area">
				<div class="name-container item-container">
					<p>会社名</p>
                    <p class="text_content">{{ $company->company_name }}</p>
					<span>※会社名を変更したい場合は<a href="mailto:impro@humo.jp">こちら</a>へお問い合わせください。</span>
				</div>
				<div class="name-container item-container">
					<p>代表者名</p>
					@if($company)
						<input class="input" type="text" name="representive_name" value="{{ old('representive_name', $company->representive_name) }}" placeholder="">
					@else
						<input class="input" type="text" name="representive_name" value="{{ old('representive_name') }}" placeholder="">
					@endif
					@if ($errors->has('representive_name'))
						<div class="error-msg">
							<strong>{{ $errors->first('representive_name') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="above-address-container">
				<div class="zipcode-container item-container">
					<p>郵便番号</p>
					<div class="zipcode-container__wrapper">
						@if($company)
							<input id="postal_front" class="input" type="text" name="zip_code_front" value="{{ old('zip_code_front', substr($company->zip_code, 0, 3)) }}" maxlength="3">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back', substr($company->zip_code, 3, 7)) }}" maxlength="4">
                            <input id="postal" type="hidden" name="zip_code">
						@else
							<input class="input" type="text" name="zip_code_front" value="{{ old('zip_code_front') }}" maxlength="3">
                            <span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back') }}" maxlength="4">
                            <input id="postal" type="hidden" name="zip_code">
						@endif
						
                    </div>
                    @if ($errors->has('zip_code'))
							<div class="error-msg">
								<strong>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
				</div>
	
				<div class="prefecture-container item-container">
					<p>都道府県</p>
					<div class="select-arrow">
						<select name="address_prefecture" id="prefecture">
							@foreach(config('consts.pref') as $_pref)
							<option value="{{ $_pref }}" {{ ($company->address_prefecture === $_pref) ? 'selected' : ''}}>{{ $_pref }}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('address_prefecture'))
						<div class="error-msg">
							<strong>{{ $errors->first('address_prefecture') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="below-address-container">
				<div class="city-container item-container">
					<p>市区町村・番地</p>
					@if($company)
						<input class="input" type="text" name="address_city" value="{{ old('address_city', $company->address_city) }}" placeholder="">
					@else
						<input class="input" type="text" name="address_city" value="{{ old('address_city') }}" placeholder="">
					@endif
					@if ($errors->has('address_city'))
						<div class="error-msg">
							<strong>{{ $errors->first('address_city') }}</strong>
						</div>
					@endif
				</div>
	
				<div class="building-container item-container">
					<p>建物名・部屋番号</p>
					@if ($company)
						<input type="text" name="address_building" value="{{ old('address_building', $company->address_building) }}">
					@else
						<input type="text" name="address_building" value="{{ old('address_building') }}">
					@endif
					@if ($errors->has('address_building'))
						<div class="error-msg">
							<strong>{{ $errors->first('address_building') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="item-container tel-container">
                <p>電話番号</p>
                <div class="tel-input-container">
                    <input type="text" name="tel" id="tel" value="{{ old('tel', $company->tel) }}" maxlength="11">
                </div>
                @if ($errors->has('tel'))
                    <div class="error-msg">
                        <strong>{{ $errors->first('tel') }}</strong>
                    </div>
                @endif
			</div>
			<div class="btn01-container">
				<button type="button" onclick="submit();">設定</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/company/setting/general/index.js') }}" defer></script>
@endsection
