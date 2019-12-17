@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/invoice/show.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>請求書プレビュー</h3>
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
                        @if($invoice->billing_to_text)
						<p>{{ $invoice->billing_to_text }}様</p>
						@else
						<p>{{ $invoice->companyUser->name }}様</p>
						@endif
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
								<th>税区分</th>
                                <th>合計</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach($invoice->requestTasks as $requestTask)
                                <tr>
                                    <td>{{ $requestTask->name }}</td>
                                    <td>{{ $requestTask->num }}</td>
                                    <td>{{ number_format($requestTask->unit_price) }}</td>
									@if($requestTask->tax == 1.10)
									<td>10%</td>
									@elseif($requestTask->tax == 1.08)
									<td>軽減8%</td>
									@else
									<td>非課税</td>
									@endif
                                    <td>{{ number_format($requestTask->total) }}</td>
                                </tr>
                            @endforeach
        
                            @foreach($invoice->requestExpences as $requestExpence)
                                <tr>
                                    <td>{{ $requestExpence->name }}</td>
                                    <td>{{ $requestExpence->num }}</td>
                                    <td>{{ number_format($requestExpence->unit_price) }}</td>
									@if($requestExpence->tax == 1.10)
									<td>10%</td>
									@elseif($requestExpence->tax == 1.08)
									<td>軽減8%</td>
									@else
									<td>非課税</td>
									@endif
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
							<p>{{ number_format($total_sum_notax) }}</p>
						</div>
		
						<div class="section-container">
							<p class="sub-column">消費税</p>
							<p>{{ number_format($total_sum - $total_sum_notax) }}</p>
						</div>
		
						<div class="section-container">
							<p class="sub-column">総額</p>
							<p class="total-text">{{ number_format($total_sum) }}</p>
						</div>
                    </div>
        
                    <div class="sub-container">
                        <span>備考</span>
                    </div>
                </div>
        
                <div class="deadline-container">
                    <div class="header-container">
                        <p>ご入金期限: {{ date("Y年m月d年", strtotime($invoice->deadline_at)) }}</p>
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
					@if($invoice->billing_to_text)
					<p>{{ $invoice->billing_to_text }}様</p>
					@else
					<p>{{ $invoice->companyUser->name }}様</p>
					@endif  
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
							<th>税区分</th>
							<th>合計</th>
						</tr>
					</thead>
	
					<tbody>
						@foreach($invoice->requestTasks as $requestTask)
							<tr>
								<td>{{ $requestTask->name }}</td>
								<td>{{ $requestTask->num }}</td>
								<td>{{ number_format($requestTask->unit_price) }}</td>
								@if($requestTask->tax == 1.10)
								<td>10%</td>
								@elseif($requestTask->tax == 1.08)
								<td>軽減8%</td>
								@else
								<td>非課税</td>
								@endif
								<td>{{ number_format($requestTask->total) }}</td>
							</tr>
						@endforeach
	
						@foreach($invoice->requestExpences as $requestExpence)
							<tr>
								<td>{{ $requestExpence->name }}</td>
								<td>{{ $requestExpence->num }}</td>
								<td>{{ number_format($requestExpence->unit_price) }}</td>
								@if($requestExpence->tax == 1.10)
								<td>10%</td>
								@elseif($requestExpence->tax == 1.08)
								<td>軽減8%</td>
								@else
								<td>非課税</td>
								@endif
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
						<p>{{ number_format($total_sum_notax) }}</p>
					</div>
					
					<div class="section-container">
						<p class="sub-column">消費税</p>
						<p>{{ number_format($total_sum - $total_sum_notax) }}</p>
					</div>
	
					<div class="section-container">
						<p class="sub-column">総額</p>
						<p class="total-text">{{ number_format($total_sum) }}</p>
					</div>
				</div>
	
				<div class="sub-container">
					<span>備考</span>
				</div>
			</div>
	
			<div class="deadline-container">
				<div class="header-container">
					<p>ご入金期限: {{ date("Y年m月d年", strtotime($invoice->deadline_at)) }}</p>
				</div>
	
				<div class="content-container">
					<p>お振込み先: {{ $partner->partnerInvoice->account_holder }}</p>
					<p>{{ $partner->partnerInvoice->financial_institution }} {{ $partner->partnerInvoice->branch }} ({{ $partner->partnerInvoice->deposit_type }}) {{ $partner->partnerInvoice->account_number }}</p>
				</div>
			</div>
		</div>
	</div>
​
	@if($task->status === 13 && in_array($company_user->id, $company_user_ids))
		<div class="actionButton">
			<form action="{{ route('company.task.status.change') }}" method="POST">
			@csrf
				<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
				<input type="hidden" name="status" value="{{ config('const.ACCEPTANCE') }}">
				<div class="button-container">
					<button type="submit" class="undone">請求書を拒否する</button>
				</div>
			</form>
			<form action="{{ route('company.task.status.change')}}" method="POST">
			@csrf
				<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
				<input type="hidden" name="status" value="{{ config('const.SUBMIT_ACCOUNTING') }}">
				<button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">経理に送信</button>
				<!-- Modal -->
				@component('components.confirm-modal')
					@slot('confirmOrNot')
						confirm
					@endslot
					@slot('confirm')
						依頼
					@endslot
					請求書を承認し、経理の {{$task->accounting->name }} さんに確認を依頼します。
				@endcomponent
			</form>
		</div>
	@elseif($task->status === 15 && $task->accounting->id === $company_user->id)
		<div class="actionButton">
			<form action="{{ route('company.task.status.change') }}" method="POST">
			@csrf
				<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
				<input type="hidden" name="status" value="{{ config('const.APPROVAL_ACCOUNTING') }}">
				<button class="undone" type="submit">請求書を拒否する</button>
			</form>
			<form action="{{ route('company.task.status.change')}}" method="POST">
			@csrf
				<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
				<input type="hidden" name="status" value="{{ config('const.INVOICE_CREATE') }}">
				<button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">請求書を承認する</button>
				<!-- Modal -->
				@component('components.confirm-modal')
					@slot('confirmOrNot')
						confirm
					@endslot
					@slot('confirm')
						承認
					@endslot
					請求書を承認します。
				@endcomponent
			</form>
		</div>
	@elseif($task->status > 14 && in_array($company_user->id, $company_user_ids))
		<p class="send-done">この請求書は承認済みです</p>
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
