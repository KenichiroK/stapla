@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/outsourceContract/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<h3 class="main-wrapper__title">業務委託契約書の作成</h3>
	<form action="" method="post" class="main-wrapper__content">
		<div class="field-wrapper">
			<div class="field">
				<label class="field__label">企業名<span class="field__label--require">（必須）</span></label>
				<input name="company_name" type="text" value="" class="field__input form-control">
			</div>
			<div class="field">
				<label class="field__label">企業住所<span class="field__label--require">（必須）</span></label>
				<input name="company_address" type="text" value="" class="field__input form-control">
			</div>
			<div class="field">
				<label class="field__label">企業代表者名<span class="field__label--require">（必須）</span></label>
				<input name="representive_name" type="text" value="" class="field__input form-control">
			</div>
			<div class="field">
				<label class="field__label">パートナー名<span class="field__label--require">（必須）</span></label>
				<input name="partner_name" type="text" value="" class="field__input form-control">
			</div>
			<div class="field">
				<label class="field__label">パートナー住所<span class="field__label--require">（必須）</span></label>
				<input name="partner_address" type="text" value="" class="field__input form-control">
			</div>
			<div class="field">
				<label class="field__label">契約締結日<span class="field__label--require">（必須）</span></label>
				{{-- TODO: カレンダーピッカーの導入 --}}
				<i id="calender-icon" class="fas fa-calendar-alt calender-icon"></i>
				<input id="contract-date-input" name="contract_date" type="text" value="" class="field__input field__input--icon form-control">
			</div>
		</div>
		<div class="contract-wrapper"></div>
	</form>
</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/company/document/outsourceContract/create.js') }}" defer></script>

@endsection
