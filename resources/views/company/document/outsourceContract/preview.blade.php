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
			{{-- <div class="pageout">
				<div id="contract" class="contract">
					@include('company.document.outsourceContract.components.contract')
				</div>
			</div> --}}
			<div id="contract" class="contract">
				@include('company.document.outsourceContract.components.contract')
			</div>
			<div class="footer">
				<form id="contract_form" action="" method="post">
					<button class="btn white" data-impro-button="once" type="button" onclick="submit();" style="margin-right: 30px;">修正する</button>
					<button id="submit_btn" class="btn" data-impro-button="once" type="button">パートナーに確認依頼をする</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('asset-js')
<script>
	// TODO: サーバサイドから入力された値を受け取る
	const COMPANY_NAME = "テスト企業";
	const COMPANY_ADDRESS = "テスト企業住所";
	const REPRESENTIVE_NAME = "代表者名";
	const PARTNER_NAME = "テストパートナ";
	const PARTNER_ADDRESS = "テストパートナ住所";
	const COURT = "さいたま";
	const CONTRACT_DATE = "令和2年1月16日";
</script>

<script src="{{ asset('js/pages/company/document/outsourceContract/preview.js') }}" defer></script>
@endsection
