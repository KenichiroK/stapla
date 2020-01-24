@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/setting/invoice/index.css') }}">
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

	@if(Session::has('not_register_invoice'))
		<div class="error-container">
			<p>{{ session('not_register_invoice') }}</p>
		</div>
  	@endif

	<div class="title-container">
		<h3>設定</h3>
	</div>

	<div class="menu-container">
		<ul>
			<li><a href="{{ route('partner.setting.invoice.create') }}" class="isActive">請求情報設定</a></li>
		</ul>
	</div>

	<form action="{{ route('partner.setting.invoice.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="profile-container">
			<div class="title-container">
				<h4>基本情報</h4>
			</div>
			<div class="yago-name-container">
				<div class="yago-container">
					<p>屋号</p>
					<input type="text" name="name" value="{{ old('name', isset(Auth::user()->name) ? Auth::user()->name : '') }}">
					@if ($errors->has('name'))
						<div class="error-msg">
							<strong>{{ $errors->first('name') }}</strong>
						</div>
					@endif
				</div>

				<div class="name-container">
					<p>名前</p>
					<input type="text" name="name" value="{{ old('name', isset(Auth::user()->name) ? Auth::user()->name : '') }}">
					@if ($errors->has('name'))
						<div class="error-msg">
							<strong>{{ $errors->first('name') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					<div class="zipcode-container__wrapper">
						<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front', isset(Auth::user()->zip_code) ? substr(Auth::user()->zip_code, 0, 3) : '') }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
						<span class="hyphen">
							<hr>
						</span>
						<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back', isset(Auth::user()->zip_code) ? substr(Auth::user()->zip_code, 3) : '') }}" maxlength="4" onchange="setPostal()">
						<input id="postal" type="hidden" name="zip_code">
					</div>
					@if ($errors->has('zip_code'))
						<div class="error-msg">
							<strong>{{ $errors->first('zip_code') }}</strong>
						</div>
					@endif
				</div>

				<div class="prefecture-container">
					<p>都道府県</p>
					<div class="select-arrow">
						<select name="prefecture">
							@foreach(config('consts.pref') as $_pref)
							<option value="{{ $_pref }}" {{ old('prefecture', isset(Auth::user()->prefecture) ? Auth::user()->prefecture : '') === $_pref ? 'selected' : '' }}>{{ $_pref }}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('prefecture'))
						<div class="error-msg">
							<strong>{{ $errors->first('prefecture') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="below-address-container">
				<div class="city-container">
					<p>市区町村・番地</p>
					<input type="text" name="city" value="{{ old('city', isset(Auth::user()->city) ? Auth::user()->city : '') }}">
					@if ($errors->has('city'))
						<div class="error-msg">
							<strong>{{ $errors->first('city') }}</strong>
						</div>
					@endif
				</div>

				<div class="building-container">
					<p>番地</p>
					<input type="text" name="street" value="{{ old('street', isset(Auth::user()->street) ? Auth::user()->street : '') }}">
					@if ($errors->has('street'))
						<div class="error-msg">
							<strong>{{ $errors->first('street') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="below-address-container">
				<div class="building-container">
					<p>建物名・部屋番号</p>
					<input type="text" name="building" value="{{ old('building', isset(Auth::user()->building) ? Auth::user()->building : '') }}">
					@if ($errors->has('building'))
						<div class="error-msg">
							<strong>{{ $errors->first('building') }}</strong>
						</div>
					@endif
				</div>

				<div class="tel-container">
					<p>電話番号</p>
					<div class="tel-container__wrapper">
                        <input type="text" name="tel" id="tel" value="{{ old('tel', isset(Auth::user()->tel) ? Auth::user()->tel : '') }}" maxlength="11">
					</div>
					@if ($errors->has('tel'))
						<div class="error-msg">
							<strong>{{ $errors->first('tel') }}</strong>
						</div>					
					@endif
				</div>
			</div>
		</div>

		<div class="invoice-container">
			<div class="title-container">
				<h4>請求情報</h4>
			</div>

			<div class="financial-container">
				<div class="financialInstitution-container">
					<p>金融機関</p>
					<input type="text" name="financial_institution" value="{{ old('financial_institution', isset($partner_invoice->financial_institution) ? $partner_invoice->financial_institution : '') }}">
					@if ($errors->has('financial_institution'))
						<div class="error-msg">
							<strong>{{ $errors->first('financial_institution') }}</strong>
						</div>
					@endif
				</div>

				<div class="branch-container">
					<p>支店</p>
					<input type="text" name="branch" value="{{ old('branch', isset($partner_invoice->branch) ?  $partner_invoice->branch : '') }}">
					@if ($errors->has('branch'))
						<div class="error-msg">
							<strong>{{ $errors->first('branch') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="depositType-container">
				<p>預金種類</p>
				<div class="select-arrow">
					<select name="deposit_type">
						<option value="普通" {{ old('deposit_type', isset($partner_invoice->deposit_type) ? $partner_invoice->deposit_type : '' ) === "普通" ? 'selected' : '' }}>普通</option>
						<option value="当座" {{ old('deposit_type', isset($partner_invoice->deposit_type) ? $partner_invoice->deposit_type : '' ) === "当座" ? 'selected' : '' }}>当座</option>
					</select>
				</div>
			</div>

			<div class="accountNumber-container">
				<p>口座番号</p>
				<input type="text" id="account_number" name="account_number" value="{{ old('account_number', isset($partner_invoice->account_number) ? $partner_invoice->account_number : '') }}" maxlength="7" onblur="convert(this.value)">
				@if ($errors->has('account_number'))
					<div class="error-msg">
						<strong>{{ $errors->first('account_number') }}</strong>
					</div>
				@endif
			</div>

			<div class="accountHolder-container">
				<p>口座名義</p>
				<input type="text" name="account_holder" value="{{ old('account_holder', isset($partner_invoice->account_holder) ? $partner_invoice->account_holder : '') }}">
				@if ($errors->has('account_holder'))
					<div class="error-msg">
						<strong>{{ $errors->first('account_holder') }}</strong>
					</div>
				@endif
			</div>
		</div>

		<div class="btn01-container">
			<button data-impro-button="once" type="button" onclick="submit();">設定</button>
		</div>
	</form>
</div>
@endsection

@section('asset-js')
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

	function convert(account_number) {
		var half_size_account_number = document.getElementById('account_number').value
		half_size_account_number = account_number.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
			return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
		});
		document.getElementById('account_number').value = half_size_account_number
	}

	// 郵便番号入力欄の自動遷移
	function nextField(t, name ,maxlength) {
		if(t.value.length >= maxlength) {
			t.form.elements[name].focus();
		}
	}

	const setPostal = () => {
		const front = document.getElementById('postal_front').value;
		const back = document.getElementById('postal_back').value;
		const postal = document.getElementById('postal');
		postal.value = front + back;
	}

	window.addEventListener('load', function(){
		setPostal();
	})
</script>
@endsection