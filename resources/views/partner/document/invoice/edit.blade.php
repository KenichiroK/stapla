@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/invoice/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	@if(count($errors) > 0)
		<div class="error-container">
			<p>入力に問題があります。再入力して下さい。</p>
		</div>
	@endif

	<div class="title-container">
		<h3>請求書作成</h3>
	</div>

	<form action="{{ route('partner.document.invoice.update',[ 'id' => $invoice->id ]) }}" method="POST">
		@csrf
		<div class="invoice-container">
			<div class="invoiceTo-container">
				<dl>
					<dt>請求先</dt>
					<dd>{{ $company->company_name }}</dd>
				</dl>

				<dl>
					<dt>住所</dt>
					<dd>〒{{ substr($company->zip_code, 0, 3) . "-" . substr($company->zip_code, 3) }} {{ $company->address_prefecture }}{{ $company->address_city }}{{ $company->address_building }}</dd>
				</dl>
			</div>
			
			<div class="form-container">
				<dl>
					<dt>担当者</dt>
					<dd>
						<div class="selectbox-container">
							<select name="company_user_id" id="staff_name" onchange="selectStaff();">
								<option value="" hidden></option>
								@foreach ($companyUsers as $companyUser)
									@if(old('company_user_id'))
									<option value="{{ $companyUser->id }}" {{ old('company_user_id') === $companyUser->id ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                    @elseif(!old('billing_to_text') && !$invoice->billing_to_text)
									<option value="{{ $companyUser->id }}" {{ $task->companyUser->id === $companyUser->id ? 'selected' : '' }}>{{ $companyUser->name }}</option>
									@endif
									<option value="{{ $companyUser->id }}" {{ old('company_user_id') === $companyUser->id ? 'selected' : '' }}>{{ $companyUser->name }}</option>
								@endforeach
							</select>
						</div>
						<input type="button" class="none-select" value="×" onclick="setNonSelect('staff_name');">
						@if ($errors->has('company_user_id'))
							<div class="error-msg">
								<strong>{{ $errors->first('company_user_id') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>

				<dl>
					<dt>担当者 <br>(自由記入)</dt>
					<dd>
                        <input class="free-staff-name" type="text" name="billing_to_text" id="free_staff_name" value="{{ old('billing_to_text', $invoice->billing_to_text) }}" disabled onchange="billingText();">
                        @if ($errors->has('billing_to_text'))
							<div class="error-msg">
								<strong>{{ $errors->first('billing_to_text') }}</strong>
							</div>					
						@endif
					</dd>
                </dl>

				<dl>
					<dt>件名</dt>
					<dd>
						<input class="task-name" type="text" name="title" value="{{ old('title', $invoice->project_name) }}">
						@if ($errors->has('title'))
							<div class="error-msg">
								<strong>{{ $errors->first('title') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>

				<dl>
					<dt>請求日</dt>
					<dd>
						<div>
							<span id="requested_at_text"></span>
							<input
								type="date"
								name="requested_at"
								value="{{ old('requested_at', $invoice->requested_at) }}"
							>

							@if($errors->has('requested_at'))
								<div class="invalid-feedback error-msg" role="alert">
									<strong>{{ $errors->first('requested_at') }}</strong>
								</div>
							@endif
						</div>
						@if ($errors->has('requested_at'))
							<div class="error-msg">
								<strong>{{ $errors->first('requested_at') }}</strong>
							</div>					
						@endif
					</dd>
					
				</dl>

				<dl>
					<dt>支払い期限</dt>
					<dd>
						<div>
							<span id="deadline_at_text"></span>
							<input
								type="date"
								name="deadline_at"
								value="{{ old('deadline_at', $invoice->deadline_at) }}"
							>
						</div>
						@if ($errors->has('deadline_at'))
							<div class="error-msg">
								<strong>{{ $errors->first('deadline_at') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>
            </div>
            
			<div class="task-container">
				<div class="title-container">
					<h4>タスク</h4>
                </div>

				<table>
					<thead>
						<tr>
							<th class="del-record"></th>
							<th class="item">品目</th>
							<th class="num">数</th>
							<th class="unit-price">単価</th>
							<th class="tax">税区分</th>
							<th class="total">合計金額</th>
						</tr>
					</thead>
					
					<tbody id="taskRequest">
                        @foreach($invoice->requestTasks as $requestTask)
							<tr>
                                <td class="del-task-record" name="task_element" onclick="delExpenceRecord(this)">×</td>
                                <td class="item"><input type="text" name="item_name[]" value="{{ old('item_name.' . $loop->index, $requestTask->name) }}"></td>
                                <td class="num"><input type="text" name="item_num[]" value="{{ old('item_num.' . $loop->index, $requestTask->num) }}" onchange="calculateSumPrice()"></td>
                                <td class="unit-price"><input type="text" name="item_unit_price[]" value="{{ old('item_unit_price.' . $loop->index,$requestTask->unit_price) }}" onchange="calculateSumPrice()"><span>円</span></td>
                                <td class="tax">
                                    <div class="selectbox-container">
                                        <select name="item_tax[]" onchange="calculateSumPrice()">	
                                            <option name="tax_10" value="1.1" {{ old('item_tax.' . $loop->index, $requestTask->tax) == '1.1' ? 'selected' : '' }}>10%</option>
                                            <option name="tax_8" value="1.08"  {{ old('item_tax.' . $loop->index, $requestTask->tax) == '1.08' ? 'selected' : '' }}>軽減8%</option>
                                            <option name="tax_none" value="1.0"  {{ old('item_tax.' . $loop->index, $requestTask->tax) == '1.0' ? 'selected' : '' }}>非課税</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="total"><p class="task_request_total"></p><span>円</span></td>
                                <input type="hidden" name="item_total[]">
                                <input type="hidden" id="task_count" value="{{ $task_count }}">
							</tr>
						@endforeach

						@for ($i = count($invoice->requestTasks); $i < $task_count; $i++)
						<tr>
							<td class="del-task-record" name="task_element" onclick="delTaskRecord(this)">×</td>
							<td class="item"><input type="text" name="item_name[]" value="{{ old('item_name.' . $i) }}"></td>
							<td class="num"><input type="text" name="item_num[]" value="{{ old('item_num.' . $i) }}" onchange="calculateSumPrice()"></td>
							<td class="unit-price"><input type="text" name="item_unit_price[]" value="{{ old('item_unit_price.' . $i) }}" onchange="calculateSumPrice()"><span>円</span></td>
							<td class="tax">
								<div class="selectbox-container">
									<select name="item_tax[]" onchange="calculateSumPrice()">
										<option name="tax_10" value="1.1" {{ old('item_tax.' . $i) == '1.1' ? 'selected' : '' }}>10%</option>
										<option name="tax_8" value="1.08" {{ old('item_tax.' . $i) == '1.08' ? 'selected' : '' }}>軽減8%</option>
										<option name="tax_none" value="1.0" {{ old('item_tax.' . $i) == '1.0' ? 'selected' : '' }}>非課税</option>
									</select>
								</div>
							</td>
							<td class="total"><p class="task_request_total"></p><span>円</span></td>
							<input type="hidden" name="item_total[]">
							<input type="hidden" value="{{ $task_count }}">
						</tr>
                        @endfor
					</tbody>
					@if ($errors->has('item_name.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('item_name.*') }}</strong>
						</div>					
					@elseif ($errors->has('item_num.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('item_num.*') }}</strong>
						</div>					
					@elseif ($errors->has('item_unit_price.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('item_unit_price.*') }}</strong>
						</div>					
					@endif

				</table>
				<div class="addButton-container">
					<button type="button" onclick="addtaskRequest()">タスクを追加</button>
				</div>
			</div>
			<div class="expences-container">
				<div class="title-container">
					<h4>経費</h4>
				</div>

				<table>
					<thead>
						<tr>
							<th class="del-record"></th>
							<th class="item">品目</th>
							<th class="num">数</th>
							<th class="unit-price">単価</th>
							<th class="tax">税区分</th>
							<th class="total">合計金額</th>
						</tr>
					</thead>
					
					<tbody id="expences">

                        @foreach($invoice->requestExpences as $requestExpence)
						<tr>
							<td class="del-expences-record" name="expences_element" onclick="delExpenceRecord(this)">×</td>
							<td class="item"><input type="text" name="expences_name[]" value="{{ old('expences_name.' . $loop->index, $requestExpence->name) }}"></td>
							<td class="num"><input type="text" name="expences_num[]" value="{{ old('expences_num.' . $loop->index, $requestExpence->num) }}" onchange="calculateSumPrice()"></td>
							<td class="unit-price"><input type="text" name="expences_unit_price[]" value="{{ old('expences_unit_price.' . $loop->index, $requestExpence->unit_price) }}" onchange="calculateSumPrice()"><span>円</span></td>
							<td class="tax">
								<div class="selectbox-container">
									<select name="expences_tax[]" onchange="calculateSumPrice()">	
										<option name="tax_10" value="1.1" {{ old('expences_tax.' . $loop->index, $requestExpence->tax) == '1.1' ? 'selected' : '' }}>10%</option>
										<option name="tax_8" value="1.08"  {{ old('expences_tax.' . $loop->index, $requestExpence->tax) == '1.08' ? 'selected' : '' }}>軽減8%</option>
										<option name="tax_none" value="1.0"  {{ old('expences_tax.' . $loop->index, $requestExpence->tax) == '1.0' ? 'selected' : '' }}>非課税</option>
									</select>
								</div>
							</td>
							<td class="total"><p class="expence_total"></p><span>円</span></td>
							<input type="hidden" name="expences_total[]">
							<input type="hidden" id="expences_count" value="{{ $expences_count }}">
						</tr>
                        @endforeach

						@for ($i = count($invoice->requestExpences); $i < $expences_count; $i++)
						<tr>
							<td class="del-expences-record" name="expences_element" onclick="delExpenceRecord(this)">×</td>
							<td class="item"><input type="text" name="expences_name[]" value="{{ old('expences_name.' . $i) }}"></td>
							<td class="num"><input type="text" name="expences_num[]" value="{{ old('expences_num.' . $i) }}" onchange="calculateSumPrice()"></td>
							<td class="unit-price"><input type="text" name="expences_unit_price[]" value="{{ old('expences_unit_price.' . $i) }}" onchange="calculateSumPrice()"><span>円</span></td>
							<td class="tax">
								<div class="selectbox-container">
									<select name="expences_tax[]" onchange="calculateSumPrice()">	
										<option name="tax_10" value="1.1" {{ old('item_tax.' . $i) == '1.1' ? 'selected' : '' }}>10%</option>
										<option name="tax_8" value="1.08"  {{ old('item_tax.' . $i) == '1.08' ? 'selected' : '' }}>軽減8%</option>
										<option name="tax_none" value="1.0"  {{ old('item_tax.' . $i) == '1.0' ? 'selected' : '' }}>非課税</option>
									</select>
								</div>
							</td>
							<td class="total"><p class="expence_total"></p><span>円</span></td>
							<input type="hidden" name="expences_total[]">
							<input type="hidden" value="{{ $expences_count }}">
						</tr>
						@endfor
					</tbody>

					@if ($errors->has('expences_name.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('expences_name.*') }}</strong>
						</div>					
					@elseif ($errors->has('expences_num.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('expences_num.*') }}</strong>
						</div>					
					@elseif ($errors->has('expences_unit_price.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('expences_unit_price.*') }}</strong>
						</div>				
					@elseif ($errors->has('expences_total.*'))
						<div class="error-msg">
							<strong>{{ $errors->first('expences_total.*') }}</strong>
						</div>					
					@endif

				</table>
				<div class="addButton-container">
					<button type="button" onclick="addExpences()">経費を追加</button>
				</div>
			</div>

			<div class="total-container">
				<p class="head">請求額</p>
				
				<div class="error-msg invoiceAmount_alert">
					<strong id="invoiceAmount_alert">請求額がタスクの発注額を超えています。</strong>
				</div>					
				
				<div class="sum-container">
					<p>税抜<span id="sum">￥0</span></p>
					<p>税込<span id="sum_plus_tax">￥0</span></p>
				</div>
			</div>
		</div>

		<input type="hidden" name="task_id" value="{{ $task->id }}">
		<input type="hidden" id="task_taxIncludedPrice" name="task_taxIncludedPrice" value="{{ $task->price + ($task->price * $task->tax) }}">
		<input type="hidden" id="invoiceAmount" name="amount" value="">
		

		<div class="actionButton">
			<button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">修正</button>
			<!-- Modal -->
			@component('components.confirm-modal')
				@slot('modalID')
					confirm
				@endslot
				@slot('confirmBtnLabel')
					修正
				@endslot
				請求書を修正して作成します。
			@endcomponent
		</div>
	</form>
</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/partner/document/invoice/create.js') }}" defer></script>
@endsection
