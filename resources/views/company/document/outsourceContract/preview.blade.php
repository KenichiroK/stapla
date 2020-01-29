@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/outsourceContract/preview.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<h3 class="main-wrapper__title">業務委託契約書のプレビュー</h3>
	<div class="main-wrapper__content">
		<div class="contract-wrapper">
			<div id="contract" class="contract">
				@include('company.document.outsourceContract.components.contract')
			</div>

			{{-- NOTE: 契約締結後は修正できなくても良いのかどうか --}}
			@if ($outsourceContract->status !== 'complete')
			<div class="footer">
				<form action="{{ route('company.document.outsource-contracts.updateStatus') }}" method="post">
					@csrf
					@if(isset($outsourceContract->comment) && $outsourceContract->status === 'progress')
					<p>パートナからの修正依頼</p>
					<p class="footer__comment">{{ $outsourceContract->comment }}</p>
					@endif

					<div class="footer__btn-wrapper">
						<a class="btn white" href="{{ route('company.document.outsource-contracts.edit', ['outsource_contract_id' => $outsourceContract->id]) }}" style="margin-right: 30px;">修正する</a>
						<button class="btn" data-impro-button="once" type="button" onclick="submit();">パートナーに確認依頼をする</button>
					</div>

					<input name="id" type="hidden" value="{{ $outsourceContract->id }}">
					<input name="status" type="hidden" value="progress">
				</form>
			</div>
			@endif
		</div>
	</div>
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

<script src="{{ asset('js/pages/company/document/outsourceContract/preview.js') }}" defer></script>
@endsection
