@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/outsourceContract/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<h3 class="main-wrapper__title">業務委託契約書の作成</h3>
	<form action="{{ route('company.document.outsourceContracts.update') }}" method="post" class="main-wrapper__content">
		@csrf
		<div class="field-wrapper">
			<div class="field">
				<label class="field__label">企業名<span class="field__label--require">（必須）</span></label>
				<input id="company_name" name="company_name" type="text" class="field__input form-control"
					@if (!empty( old('company_name') ))
					value="{{ old('company_name') }}"
					@else
					value="{{ $outsourceContract->company_name }}"
					@endif
				>
				@if ($errors->has('company_name'))
					<div class="error-msg">
						<strong>{{ $errors->first('company_name') }}</strong>
					</div>
				@endif
			</div>
			<div class="field">
				<label class="field__label">企業住所<span class="field__label--require">（必須）</span></label>
				<input id="company_address" name="company_address" type="text" class="field__input form-control"
					@if (!empty( old('company_address') ))
					value="{{ old('company_address') }}"
					@else
					value="{{ $outsourceContract->company_address }}"
					@endif
				>
				@if ($errors->has('company_address'))
					<div class="error-msg">
						<strong>{{ $errors->first('company_address') }}</strong>
					</div>
				@endif
			</div>
			<div class="field">
				<label class="field__label">企業代表者名<span class="field__label--require">（必須）</span></label>
				<input id="representive_name" name="representive_name" type="text" class="field__input form-control"
					@if (!empty( old('representive_name') ))
					value="{{ old('representive_name') }}"
					@else
					value="{{ $outsourceContract->representive_name }}"
					@endif
				>
				@if ($errors->has('representive_name'))
					<div class="error-msg">
						<strong>{{ $errors->first('representive_name') }}</strong>
					</div>
				@endif
			</div>
			<div class="field">
				<label class="field__label">パートナー名<span class="field__label--require">（必須）</span></label>
				<input id="partner_name" name="partner_name" type="text" class="field__input form-control"
					@if (!empty( old('partner_name') ))
					value="{{ old('partner_name') }}"
					@else
					value="{{ $outsourceContract->partner_name }}"
					@endif
				>
				@if ($errors->has('partner_name'))
					<div class="error-msg">
						<strong>{{ $errors->first('partner_name') }}</strong>
					</div>
				@endif
			</div>
			<div class="field">
				<label class="field__label">パートナー住所<span class="field__label--require">（必須）</span></label>
				<input id="partner_address" name="partner_address" type="text" class="field__input form-control"
					@if (!empty( old('partner_address') ))
					value="{{ old('partner_address') }}"
					@else
					value="{{ $outsourceContract->partner_address }}"
					@endif
				>
				@if ($errors->has('partner_address'))
					<div class="error-msg">
						<strong>{{ $errors->first('partner_address') }}</strong>
					</div>
				@endif
			</div>
			<div class="field">
				<label class="field__label">契約締結日<span class="field__label--require">（必須）</span></label>
				<i id="calender_icon" class="fas fa-calendar-alt calender-icon"></i>
				<input id="contract_date_input" name="contract_date" type="text" class="field__input field__input--icon form-control"
					@if (!empty( old('contract_date') ))
					value="{{ old('contract_date') }}"
					@else
					value="{{ $outsourceContract->contarcted_at }}"
					@endif
				>
				@if ($errors->has('contract_date'))
					<div class="error-msg">
						<strong>{{ $errors->first('contract_date') }}</strong>
					</div>
				@endif
			</div>
			<div class="control">
				<label class="field__label">裁判所<span class="field__label--require">（必須）</span></label>
				<div class="select is">
					<select id="court" name="court" class="form-control" style="font-size: 14px;">
						@if (!empty( old('court')))
						<option selected value="{{ old('court') }}">{{ old('court') }}</option>
						@else
						<option selected value="{{ $outsourceContract->court_name }}">{{ $outsourceContract->court_name }}</option>
						@endif
						@include('company.document.outsourceContract.components.court')
					</select>
				</div>
				@if ($errors->has('court'))
					<div class="error-msg">
						<strong>{{ $errors->first('court') }}</strong>
					</div>
				@endif
			</div>
			<input name="company_id" type="hidden" value="{{ $outsourceContract->company_id }}">
			<input name="partner_id" type="hidden" value="{{ $outsourceContract->partner_id }}">
			<input name="id" type="hidden" value="{{ $outsourceContract->id }}">
		</div>
		<div class="contract-wrapper">
			<div class="contract">
				@include('company.document.outsourceContract.components.contract')
			</div>

			<button class="contract-wrapper__btn" data-impro-button="once" type="button" onclick="submit();">プレビューを確認する</button>
		</div>
	</form>
</div>
@endsection

@section('asset-js')
<script>
	const COMPANY_NAME = "{{ $outsourceContract->company_name }}";
	const COMPANY_ADDRESS = "{{ $outsourceContract->company_address }}";
	const REPRESENTIVE_NAME = "{{ $outsourceContract->representive_name }}";
	const PARTNER_NAME = "{{ $outsourceContract->partner_name }}";
	const PARTNER_ADDRESS = "{{ $outsourceContract->partner_address }}";
	const COURT = "{{ $outsourceContract->court_name }}";

	const contractDate = "{{ $outsourceContract->contarcted_at }}"
	const CONTRACT_DATE = new Date(contractDate).toLocaleDateString("ja-JP-u-ca-japanese", {
		era: "long",
		year: "numeric",
		month: "long",
		day: "numeric",
	});
</script>

<script src="{{ asset('js/pages/company/document/outsourceContract/create.js') }}" defer></script>
@endsection