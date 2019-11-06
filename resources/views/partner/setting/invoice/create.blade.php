@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/setting/invoice/index.css') }}">
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

const setTel = () => {
	const tel_front = document.getElementById('tel_front').value;
	const tel_middle = document.getElementById('tel_middle').value;
	const tel_back = document.getElementById('tel_back').value;
	const tel = document.getElementById('tel');
	tel.value = tel_front + tel_middle + tel_back;
}

window.onload = () => {
	setPostal();
	setTel();
}
</script>
@endsection

@section('content')
<?php
$pref = array(
    '北海道',
    '青森県',
    '岩手県',
    '宮城県',
    '秋田県',
    '山形県',
    '福島県',
    '茨城県',
    '栃木県',
    '群馬県',
    '埼玉県',
    '千葉県',
    '東京都',
    '神奈川県',
    '新潟県',
    '富山県',
    '石川県',
    '福井県',
    '山梨県',
    '長野県',
    '岐阜県',
    '静岡県',
    '愛知県',
    '三重県',
    '滋賀県',
    '京都府',
    '大阪府',
    '兵庫県',
    '奈良県',
    '和歌山県',
    '鳥取県',
    '島根県',
    '岡山県',
    '広島県',
    '山口県',
    '徳島県',
    '香川県',
    '愛媛県',
    '高知県',
    '福岡県',
    '佐賀県',
    '長崎県',
    '熊本県',
    '大分県',
    '宮崎県',
    '鹿児島県',
    '沖縄県'
);
?>
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
					@if (Auth::user())
						<input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
					@else
						<input type="text" name="name" value="{{ old('name') }}">
					@endif
					@if ($errors->has('name'))
						<div class="error-msg">
							<strong>{{ $errors->first('name') }}</strong>
						</div>
					@endif
				</div>

				<div class="name-container">
					<p>名前</p>
					@if (Auth::user())
						<input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
					@else
						<input type="text" name="name" value="{{ old('name') }}">
					@endif
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
						@if (Auth::user())
							<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front', substr(Auth::user()->zip_code, 0, 3)) }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back', substr(Auth::user()->zip_code, 3, 7)) }}" maxlength="4" onchange="setPostal()">
							<input id="postal" type="hidden" name="zip_code">
						@else
							<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front') }}" maxlength="3" onKeyUp="nextField(this, 'zip_code_back', 3)" onchange="setPostal()">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back') }}" maxlength="4" onchange="setPostal()">
							<input id="postal" type="hidden" name="zip_code">
						@endif
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
							@foreach($pref as $_pref)
							<option value="{{ $_pref }}" {{ (Auth::user()->prefecture === $_pref) ? 'selected' : '' }}>{{ $_pref }}</option>
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
					@if (Auth::user())
						<input type="text" name="city" value="{{ old('city', Auth::user()->city) }}">
					@else
						<input type="text" name="city" value="{{ old('city') }}">
					@endif
					@if ($errors->has('city'))
						<div class="error-msg">
							<strong>{{ $errors->first('city') }}</strong>
						</div>
					@endif
				</div>

				<div class="building-container">
					<p>番地</p>
					@if (Auth::user())
						<input type="text" name="street" value="{{ old('street', Auth::user()->street) }}">
					@else
						<input type="text" name="street" value="{{ old('street') }}">
					@endif
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
					@if (Auth::user())
						<input type="text" name="building" value="{{ old('building', Auth::user()->building) }}">
					@else
						<input type="text" name="building" value="{{ old('building') }}">
					@endif
					@if ($errors->has('building'))
						<div class="error-msg">
							<strong>{{ $errors->first('building') }}</strong>
						</div>
					@endif
				</div>

				<div class="tel-container">
					<p>電話番号</p>
					<div class="tel-container__wrapper">
							<input type="text" name="tel_front" id="tel_front" value="{{ old('tel_front', substr(Auth::user()->tel, 0, 3)) }}" onchange="setTel()">
								<span class="hyphen">
									<hr>
								</span>
							<input type="text" name="tel_middle" id="tel_middle" value="{{ old('tel_middle', substr(Auth::user()->tel, 3, 4)) }}" onchange="setTel()">
								<span class="hyphen">
									<hr>
								</span>
							<input type="text" name="tel_back" id="tel_back" value="{{ old('tel_back', substr(Auth::user()->tel, 7)) }}" onchange="setTel()">
							<input type="hidden" name="tel" id="tel">
						
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
					@if ($partner_invoice)
						<input type="text" name="financial_institution" value="{{ old('financial_institution', $partner_invoice->financial_institution) }}">
					@else
						<input type="text" name="financial_institution" value="{{ old('financial_institution') }}">
					@endif
					@if ($errors->has('financial_institution'))
						<div class="error-msg">
							<strong>{{ $errors->first('financial_institution') }}</strong>
						</div>
					@endif
				</div>

				<div class="branch-container">
					<p>支店</p>
					@if ($partner_invoice)
						<input type="text" name="branch" value="{{ old('branch', $partner_invoice->branch) }}">
					@else
						<input type="text" name="branch" value="{{ old('branch') }}">
					@endif
					@if ($errors->has('branch'))
						<div class="error-msg">
							<strong>{{ $errors->first('branch') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="depositType-container">
				<p>預金種類</p>
				@if ($partner_invoice)
					<input type="text" name="deposit_type" value="{{ old('deposit_type', $partner_invoice->deposit_type) }}">
				@else
					<input type="text" name="deposit_type" value="{{ old('deposit_type') }}">
				@endif
				@if ($errors->has('deposit_type'))
					<div class="error-msg">
						<strong>{{ $errors->first('deposit_type') }}</strong>
					</div>
				@endif
			</div>

			<div class="accountNumber-container">
				<p>口座番号</p>
				@if ($partner_invoice)
					<input type="text" name="account_number" value="{{ old('account_number', $partner_invoice->account_number) }}" maxlength="7">
				@else
					<input type="text" name="account_number" value="{{ old('account_number') }}" maxlength="7">
				@endif
				@if ($errors->has('account_number'))
					<div class="error-msg">
						<strong>{{ $errors->first('account_number') }}</strong>
					</div>
				@endif
			</div>

			<div class="accountHolder-container">
				<p>口座名義</p>
				@if ($partner_invoice)
					<input type="text" name="account_holder" value="{{ old('account_holder', $partner_invoice->account_holder) }}">
				@else
					<input type="text" name="account_holder" value="{{ old('account_holder') }}">
				@endif
				@if ($errors->has('account_holder'))
					<div class="error-msg">
						<strong>{{ $errors->first('account_holder') }}</strong>
					</div>
				@endif
			</div>
		</div>

		<div class="btn01-container">
			<button type="button" onclick="submit();">設定</button>
		</div>
	</form>
</div>
@endsection
