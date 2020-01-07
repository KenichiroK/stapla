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
		<h3>納品</h3>
	</div>

	<form action="{{ route('partner.invoice.store') }}" method="POST">
		@csrf
		<div class="invoice-container">
			
			<div class="form-container">
				<dl>
					<dt>担当者</dt>
					<dd>
						<div class="selectbox-container">
							<select name="company_user_id">
								
							</select>
						</div>
						@if ($errors->has('company_user_id'))
							<div class="error-msg">
								<strong>{{ $errors->first('company_user_id') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>

				<dl>
					<dt>件名</dt>
					<dd>
						<input class="task-name" type="text" name="title" value="{{ old('title') }}">
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
						<div class="radio-container">
							<span id="requested_at_text"></span>
							<input
								class="radio-input"
								type="radio"
								name="requested_at"
								value="{{ date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y'))) }}"
								id="end_of_last_month"
								onclick="checkInvoiceDate()"
								{{ old('requested_at') === date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y'))) ? 'checked' : '' }}
							>
							<label for="end_of_last_month">先月末にする</label>
							<input
								class="radio-input"
								type="radio"
								name="requested_at"
								value="{{ date('Y-m-t') }}"
								id="end_of_this_month"
								onclick="checkInvoiceDate()"
								{{ old('requested_at') === date('Y-m-t') ? 'checked' : '' }}
							>
							<label for="end_of_this_month">今月末にする</label>
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
						<div class="radio-container">
							<span id="deadline_at_text"></span>
							<input
								class="radio-input"
								type="radio"
								name="deadline_at"
								value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) }}"
								id="end_of_next_month"
								onclick="checkDeadline()"
								{{ old('deadline_at') === date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) ? 'checked' : '' }}
							>
							<label for="end_of_next_month">来月末にする</label>
							<input
								class="radio-input"
								type="radio"
								name="deadline_at"
								value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) }}"
								id="end_of_month_after_next"
								onclick="checkDeadline()"
								{{ old('deadline_at') === date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) ? 'checked' : '' }}
							>
							<label for="end_of_month_after_next">再来月末にする</label>
						</div>
						@if ($errors->has('deadline_at'))
							<div class="error-msg">
								<strong>{{ $errors->first('deadline_at') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>

				<dl>
					<dt>消費税</dt>
					<dd>
						<div class="radio-container">
							<input
								class="radio-input"
								type="radio"
								name="tax"
								value="1"
								id="include_tax"
								{{ old('tax') === "1" ? 'checked' : '' }}
							>
							<label for="include_tax">税込表示(10%)</label>
							<input
								class="radio-input"
								type="radio"
								name="tax"
								value="0"
								id="not_include_tax"
								{{ old('tax') === "0" ? 'checked' : '' }}
							>
							<label for="not_include_tax">税別表示</label>
						</div>
						@if ($errors->has('tax'))
							<div class="error-msg">
								<strong>{{ $errors->first('tax') }}</strong>
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
							<th class="item">品目</th>
							<th class="num">数</th>
							<th class="unit-price">単価</th>
							<th class="total">合計金額</th>
						</tr>
					</thead>
					
					<tbody id="taskRequest">
						<tr>
							<td class="item"><input type="text" name="item_name[]"></td>
							<td class="num"><input type="text" name="item_num[]" onchange="calculateSumPrice(this.value)"></td>
							<td class="unit-price"><input type="text" name="item_unit_price[]" onchange="calculateSumPrice(this.value)"><span>円</span></td>
							<td class="total"><p class="task_request_total"></p><span>円</span></td>
							<input type="hidden" name="item_total[]">
						</tr>
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
							<th class="item">品目</th>
							<th class="num">数</th>
							<th class="unit-price">単価</th>
							<th class="total">合計金額</th>
						</tr>
					</thead>
					
					<tbody id="expences">
						<tr>
							<td class="item"><input type="text" name="expences_name[]"></td>
							<td class="num"><input type="text" name="expences_num[]" onchange="calculateSumPrice(this.value)"></td>
							<td class="unit-price"><input type="text" name="expences_unit_price[]" onchange="calculateSumPrice(this.value)"><span>円</span></td>
							<td class="total"><p class="expence_total"></p><span>円</span></td>
							<input type="hidden" name="expences_total[]">
							
						</tr>
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
		

		<div class="button-container">
			<button data-impro-button="once" type="button" onclick="submit();">納品</button>
		</div>
	</form>
</div>
@endsection
