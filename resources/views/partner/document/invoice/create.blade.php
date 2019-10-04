@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/invoice/create.css') }}">
<script>
const checkInvoiceDate = () => {
  const requestedAtRadio = document.getElementsByName('requested_at');
  const requestedAtText = document.getElementById('requested_at_text');
  if (requestedAtRadio[0].checked) {
    const dateArr = requestedAtRadio[0].value.split('-');
    requestedAtText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  } else if (requestedAtRadio[1].checked) {
    const dateArr = requestedAtRadio[1].value.split('-');
    requestedAtText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  }
}

const checkDeadline = () => {
  const deadlineAtRadio = document.getElementsByName('deadline_at');
  const deadlineAtText = document.getElementById('deadline_at_text');
  if (deadlineAtRadio[0].checked) {
    const dateArr = deadlineAtRadio[0].value.split('-');
    deadlineAtText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  } else if (deadlineAtRadio[1].checked) {
    const dateArr = deadlineAtRadio[1].value.split('-');
    deadlineAtText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  }
}

const calculateSumPrice = (e) => {
  let sum = document.getElementById('sum');
  let itemNums = document.getElementsByName('item_num[]');
  let itemUnitPrices = document.getElementsByName('item_unit_price[]');
  let itemTotals = document.getElementsByName('item_total[]');
  let taskRequestTotals = document.querySelectorAll('.task_request_total');
  let expencesNums = document.getElementsByName('expences_num[]');
  let expencesUnitPrices = document.getElementsByName('expences_unit_price[]');
  let expencesTotals = document.getElementsByName('expences_total[]');
  let expenceTotals = document.querySelectorAll('.expence_total');
  let taskSum = 0;
  let expencesSum = 0;
  for (i = 0; i < itemNums.length; i++) {
    const taskNum = itemNums[i].value === undefined ? 0 : Number(itemNums[i].value);
    const taskUnitPrice = itemUnitPrices[i].value === undefined ? 0 : Number(itemUnitPrices[i].value);
    if (taskNum !== 0 && taskUnitPrice !== 0) taskRequestTotals[i].textContent = taskNum * taskUnitPrice;
    if (taskNum !== 0 && taskUnitPrice !== 0) itemTotals[i].value = taskNum * taskUnitPrice;
    taskSum += taskNum * taskUnitPrice;
  }

  for (i = 0; i < expencesNums.length; i++) {
    const expencesNum = expencesNums[i].value === undefined ? 0 : Number(expencesNums[i].value);
    const expencesUnitPrice = expencesUnitPrices[i].value === undefined ? 0 : Number(expencesUnitPrices[i].value);
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expenceTotals[i].textContent = expencesNum * expencesUnitPrice;
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expencesTotals[i].value = expencesNum * expencesUnitPrice;
    expencesSum += expencesNum * expencesUnitPrice;
  }
  sum.textContent = `￥${(taskSum + expencesSum).toLocaleString()}`;

  // タスク予算額
  let task_taxIncludedPriceValue = document.getElementById('task_taxIncludedPrice').value;
  console.log(task_taxIncludedPriceValue);
  task_taxIncludedPrice = Number(task_taxIncludedPriceValue);
  console.log(task_taxIncludedPrice);
  console.log(typeof task_taxIncludedPrice);

  // 請求書合計金額
  let invoiceAmount = document.getElementById('invoiceAmount').value;
  invoiceAmount = taskSum + expencesSum;
  console.log(invoiceAmount);
  console.log(typeof invoiceAmount);

  const invoiceAmount_alert = document.getElementById('invoiceAmount_alert');
//   console.log(invoiceAmount_alert.style.color);

    if(task_taxIncludedPrice < invoiceAmount){
		invoiceAmount_alert.style.display = 'block';
	}else {
		invoiceAmount_alert.style.display = 'none';
	}
}

const addtaskRequest = () => {
  const taskRequest = document.getElementById('taskRequest');
  const inner = `
    <tr>
	  <td class="item"><input type="text" name="item_name[]"></td>
	  <td class="num"><input type="text" name="item_num[]" onchange="calculateSumPrice(this.value)"></td>
	  <td class="unit-price"><input type="text" name="item_unit_price[]" onchange="calculateSumPrice(this.value)"><span>円</span></td>
	  <td class="total"><p class="task_request_total"></p><span>円</span></td>
	  <input type="hidden" name="item_total[]">
	</tr>`;
  taskRequest.insertAdjacentHTML('beforeend', inner);
}

const addExpences = () => {
  const expences = document.getElementById('expences');
  const inner = `
	  <tr>
		<td class="item"><input type="text" name="expences_name[]"></td>
		<td class="num"><input type="text" name="expences_num[]" onchange="calculateSumPrice(this.value)"></td>
		<td class="unit-price"><input type="text" name="expences_unit_price[]" onchange="calculateSumPrice(this.value)"><span>円</span></td>
		<td class="total"><p class="expence_total"></p><span>円</span></td>
		<input type="hidden" name="expences_total[]">
	  </tr>`;
  expences.insertAdjacentHTML('beforeend', inner);
}

window.onload = () => {
  checkInvoiceDate();
  checkDeadline();
}
</script>
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

	<form action="{{ route('partner.setting.invoice.store') }}" method="POST">
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
							<select name="company_user_id">
								<option value="" hidden></option>
								@foreach ($task->taskCompanies as $companyUser)
									<option value="{{ $companyUser->companyUser->id }}" {{ old('company_user_id') === $companyUser->companyUser->id ? 'selected' : '' }}>{{ $companyUser->companyUser->name }}</option>
								@endforeach
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
							<label for="include_tax">税込表示</label>
							<input
								class="radio-input"
								type="radio"
								name="tax"
								value="0"
								id="not_include_tax"
								{{ old('tax') === "0" ? 'checked' : '' }}
							>
							<label for="not_include_tax">税別表示 (8%)</label>
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
					<p>税込<span id="sum">￥0</span></p>
				</div>
			</div>
		</div>

		<input type="hidden" name="task_id" value="{{ $task->id }}">
		<input type="hidden" id="task_taxIncludedPrice" name="task_taxIncludedPrice" value="{{ $task->price + ($task->price * $task->tax) }}">
		<input type="hidden" id="invoiceAmount" name="amount" value="">
		

		<div class="button-container">
			<button type="button" onclick="submit();">作成</button>
		</div>
	</form>
</div>
@endsection
