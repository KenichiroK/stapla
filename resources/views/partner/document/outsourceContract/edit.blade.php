@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/outsourceContract/edit.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<h3 class="main-wrapper__title">業務委託契約書のプレビュー</h3>
	<div class="main-wrapper__content">
		<div class="contract-wrapper">
			<div id="contract" class="contract">
				@include('company.document.outsourceContract.components.contract')
			</div>
			@if ($outsourceContract->status !== 'complete')
			<div class="footer">
				<form method="post" class="contract-form" name="contractForm">
					@csrf
					<button class="btn" data-impro-button="once" type="button" onclick="contractForm.action='{{ route('partner.document.outsource-contracts.updateStatus') }}';contractForm.submit();">契約内容に合意する</button>

					{{-- HACK: textareaタグ内の改行でvalueに余分な空白ができるので一行にまとめてるところ --}}
					<textarea class="textarea form-control" name="comment" placeholder="修正を依頼したい内容を記載してください">@if (!empty(old('comment'))){{ old('comment') }}@else{{ $outsourceContract->comment }}@endif</textarea>
					@if ($errors->has('comment'))
					<div class="error-msg" style="magin-bottom: 20px;">
						<strong>{{ $errors->first('comment') }}</strong>
					</div>
					@endif

					<button class="btn white" data-impro-button="once" type="button" onclick="contractForm.action='{{ route('partner.document.outsource-contracts.updateComment') }}';contractForm.submit();" style="margin-top: 20px;">修正を依頼する</button>

					<input type="hidden" name="id" value="{{ $outsourceContract->id }}">
					<input type="hidden" name="status" value="complete">
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

<script src="{{ asset('js/pages/partner/document/outsourceContract/edit.js') }}" defer></script>
@endsection
