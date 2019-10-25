@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/invoice/show.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>請求書プレビュー</h3>
		<!-- downloadボタン -->
		<div class="download-btn-container">
			<a id="print_btn" class="button download-button">ダウンロード</a>
		</div>
	</div>
	<div id="print" class="document-container A4">
		<!-- 印刷用 -->
		<div class="pageout">
			<div id="pdf_content" class="document-container__wrapper sheet padding-10mm">
				<div class="title-container">
					<h4>請求書</h4>
				</div>
		
				<div class="company-container">
					<div class="left">
						<p>〒{{ substr($invoice->company->zip_code, 0, 3) . "-" . substr($invoice->company->zip_code, 3) }}</p>
						<p>{{ $invoice->company->address_prefecture }}{{ $invoice->company->address_city }}{{ $invoice->company->address_building }}</p>
						<p>{{ $invoice->company->company_name }}</p>
						<p>{{ $invoice->companyUser->name }}様</p>
					</div>
		
					<div class="right">
						<p>発注日: {{ date("Y年m月d日", strtotime($invoice->requested_at)) }}</p>
						<p>{{ $invoice->partner->name }}</p>
						<p>{{ $invoice->partner->prefecture }}{{ $invoice->partner->city }}{{ $invoice->partner->building }}</p>
					</div>
				</div>
		
				<div class="invoice-container">
					<table>
						<thead>
							<tr>
								<th>商品名</th>
								<th>数量</th>
								<th>単価</th>
								<th>合計</th>
							</tr>
						</thead>
		
						<tbody>
							@foreach($invoice->requestTasks as $requestTask)
								<tr>
									<td>{{ $requestTask->name }}</td>
									<td>{{ $requestTask->num }}</td>
									<td>{{ number_format($requestTask->unit_price) }}</td>
									<td>{{ number_format($requestTask->total) }}</td>
								</tr>
							@endforeach
		
							@foreach($invoice->requestExpences as $requestExpence)
								<tr>
									<td>{{ $requestExpence->name }}</td>
									<td>{{ $requestExpence->num }}</td>
									<td>{{ number_format($requestExpence->unit_price) }}</td>
									<td>{{ number_format($requestExpence->total) }}</td>
								</tr>
							@endforeach
							@if ((count($invoice->requestTasks) + count($invoice->requestExpences)) < 6) 
								@for ($i = 0; $i < 6 - (count($invoice->requestTasks) + count($invoice->requestExpences)); $i++)
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@endfor
							@endif
						</tbody>
					</table>
		
					<div class="total-container">
						<div class="text-container">
							<p>合計</p>
						</div>
		
						<div class="section-container">
							<p class="sub-column">税抜</p>
							@if ($invoice->tax === 0)
								<p>{{ number_format($total_sum) }}</p>
							@else
								<p>{{ number_format($total_sum / 1.10) }}</p>
							@endif
						</div>
		
						<div class="section-container">
							<p class="sub-column">消費税</p>
							@if ($invoice->tax === 0)
								<p>{{ number_format($total_sum * 0.10) }}</p>
							@else
								<p>{{ number_format($total_sum / 1.10 * 0.10) }}</p>
							@endif
						</div>
		
						<div class="section-container">
							<p class="sub-column">総額</p>
							@if ($invoice->tax === 0)
								<p class="total-text">{{ number_format($total_sum * 1.10) }}</p>
							@else
								<p class="total-text">{{ number_format($total_sum) }}</p>
							@endif
						</div>
					</div>
		
					<div class="sub-container">
						<span>備考</span>
					</div>
				</div>
		
				<div class="deadline-container">
					<div class="header-container">
						<p>ご入金期限: {{ date("Y年m月d日", strtotime($invoice->deadline_at)) }}</p>
					</div>
		
					<div class="content-container">
						<p>お振込み先: {{ $partner->partnerInvoice->account_holder }}</p>
						<p>{{ $partner->partnerInvoice->financial_institution }} {{ $partner->partnerInvoice->branch }} ({{ $partner->partnerInvoice->deposit_type }}) {{ $partner->partnerInvoice->account_number }}</p>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 表示用 -->
		<div class="document-container__wrapper sheet padding-10mm">
			<div class="title-container">
				<h4>請求書</h4>
			</div>
	
			<div class="company-container">
				<div class="left">
					<p>〒{{ substr($invoice->company->zip_code, 0, 3) . "-" . substr($invoice->company->zip_code, 3) }}</p>
					<p>{{ $invoice->company->address_prefecture }}{{ $invoice->company->address_city }}{{ $invoice->company->address_building }}</p>
					<p>{{ $invoice->company->company_name }}</p>
					<p>{{ $invoice->companyUser->name }}様</p>
				</div>
	
				<div class="right">
					<p>発注日: {{ date("Y年m月d日", strtotime($invoice->requested_at)) }}</p>
					<p>{{ $invoice->partner->name }}</p>
					<p>{{ $invoice->partner->prefecture }}{{ $invoice->partner->city }}{{ $invoice->partner->building }}</p>
				</div>
			</div>
	
			<div class="invoice-container">
				<table>
					<thead>
						<tr>
							<th>商品名</th>
							<th>数量</th>
							<th>単価</th>
							<th>合計</th>
						</tr>
					</thead>
	
					<tbody>
						@foreach($invoice->requestTasks as $requestTask)
							<tr>
								<td>{{ $requestTask->name }}</td>
								<td>{{ $requestTask->num }}</td>
								<td>{{ number_format($requestTask->unit_price) }}</td>
								<td>{{ number_format($requestTask->total) }}</td>
							</tr>
						@endforeach
	
						@foreach($invoice->requestExpences as $requestExpence)
							<tr>
								<td>{{ $requestExpence->name }}</td>
								<td>{{ $requestExpence->num }}</td>
								<td>{{ number_format($requestExpence->unit_price) }}</td>
								<td>{{ number_format($requestExpence->total) }}</td>
							</tr>
						@endforeach

						@if ((count($invoice->requestTasks) + count($invoice->requestExpences)) < 6) 
							@for ($i = 0; $i < 6 - (count($invoice->requestTasks) + count($invoice->requestExpences)); $i++)
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							@endfor
						@endif

					</tbody>
				</table>
	
				<div class="total-container">
					<div class="text-container">
						<p>合計</p>
					</div>
	
					<div class="section-container">
						<p class="sub-column">税抜</p>
						@if ($invoice->tax === 0)
							<p>{{ number_format($total_sum) }}</p>
						@else
							<p>{{ number_format($total_sum / 1.10) }}</p>
						@endif
					</div>
	
					<div class="section-container">
						<p class="sub-column">消費税</p>
						@if ($invoice->tax === 0)
							<p>{{ number_format($total_sum * 0.10) }}</p>
						@else
							<p>{{ number_format($total_sum / 1.10 * 0.10) }}</p>
						@endif
					</div>
	
					<div class="section-container">
						<p class="sub-column">総額</p>
						@if ($invoice->tax === 0)
							<p class="total-text">{{ number_format($total_sum * 1.10) }}</p>
						@else
							<p class="total-text">{{ number_format($total_sum) }}</p>
						@endif
					</div>
				</div>
	
				<div class="sub-container">
					<span>備考</span>
				</div>
			</div>
	
			<div class="deadline-container">
				<div class="header-container">
					<p>ご入金期限: {{ date("Y年m月d日", strtotime($invoice->deadline_at)) }}</p>
				</div>
	
				<div class="content-container">
					<p>お振込み先: {{ $partner->partnerInvoice->account_holder }}</p>
					<p>{{ $partner->partnerInvoice->financial_institution }} {{ $partner->partnerInvoice->branch }} ({{ $partner->partnerInvoice->deposit_type }}) {{ $partner->partnerInvoice->account_number }}</p>
				</div>
			</div>
		</div>
	</div>

	@if($task->status === 12 && $task->partner->id === $partner->id)
		<div class="actionButton">
			<a href="{{ route('partner.document.invoice.create', ['id' => $task->id]) }}" class="undone">作り直す</a>
			<form action="{{ route('partner.task.status.change') }}" method="POST">
			@csrf
				<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
				<input type="hidden" name="status" value="13">
				<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
				<div class="button-container">
					<button type="submit">送信</button>
				</div>
			</form>
		</div>
	@elseif($task->status > 12 && $task->partner->id === $partner->id)
		<p class="send-done">この請求書は提出済みです</p>
	@else
		<p class="send-done">必要なアクションはありません</p>
	@endif

	<div class="error-message-wrapper">
		@if ($errors->has('task_id'))
			<div class="error-msg" role="alert">
				<strong>{{ $errors->first('task_id') }}</strong>
			</div>
		@endif
		@if ($errors->has('status') && !$errors->has('task_id'))
			<div class="error-msg" role="alert">
				<strong>{{ $errors->first('status') }}</strong>
			</div>
		@endif
	</div>
</div>
@endsection

@section('asset-js')
    <script src="{{ asset('js/pdf.js') }}" defer></script>
@endsection
