@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/invoice/create.css') }}">

<script>
const calculateSumPrice = (e) => {
  var sum = document.getElementById('sum');
  var itemNums = document.getElementsByName('item_num[]');
  var itemUnitPrices = document.getElementsByName('item_unit_price[]');
  var itemTaxes = document.getElementsByName('item_tax[]');
  var itemTotals = document.getElementsByName('item_total[]');
  var taskRequestTotals = document.querySelectorAll('.task_request_total');
  var expencesNums = document.getElementsByName('expences_num[]');
  var expencesUnitPrices = document.getElementsByName('expences_unit_price[]');
  var expencesTaxes = document.getElementsByName('expences_tax[]');
  var expencesTotals = document.getElementsByName('expences_total[]');
  var expenceTotals = document.querySelectorAll('.expence_total');
  var taskSum = 0;
  var taskSumTax = 0;
  var expencesSum = 0;
  var expencesSumTax = 0;
  for (i = 0; i < itemNums.length; i++) {
    const taskNum = itemNums[i].value === undefined ? 0 : Number(itemNums[i].value);
    const taskUnitPrice = itemUnitPrices[i].value === undefined ? 0 : Number(itemUnitPrices[i].value);
    const taskTax = itemTaxes[i].value === undefined ? 0 : Number(itemTaxes[i].value);
    if (taskNum !== 0 && taskUnitPrice !== 0) taskRequestTotals[i].textContent = Math.floor(taskNum * taskUnitPrice * taskTax);
    if (taskNum !== 0 && taskUnitPrice !== 0) itemTotals[i].value = Math.floor(taskNum * taskUnitPrice * taskTax);
    taskSum += taskNum * taskUnitPrice;
	taskSumTax +=  taskNum * taskUnitPrice * taskTax;
  }

  for (i = 0; i < expencesNums.length; i++) {
    const expencesNum = expencesNums[i].value === undefined ? 0 : Number(expencesNums[i].value);
    const expencesUnitPrice = expencesUnitPrices[i].value === undefined ? 0 : Number(expencesUnitPrices[i].value);
    const expencesTax = expencesTaxes[i].value === undefined ? 0 : Number(expencesTaxes[i].value);
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expenceTotals[i].textContent = Math.floor(expencesNum * expencesUnitPrice * expencesTax);
    if (expencesNum !== 0 && expencesUnitPrice !== 0) expencesTotals[i].value = Math.floor(expencesNum * expencesUnitPrice * expencesTax);
    expencesSum += expencesNum * expencesUnitPrice;
    expencesSumTax += expencesNum * expencesUnitPrice * expencesTax;
  }
  sum.textContent = `￥${(taskSum + expencesSum).toLocaleString()}`;
  sum_plus_tax.textContent = `￥${Math.floor(taskSumTax + expencesSumTax).toLocaleString()}`;

  // タスク予算額
  var task_taxIncludedPriceValue = document.getElementById('task_taxIncludedPrice').value;
  task_taxIncludedPrice = Number(task_taxIncludedPriceValue);

  // 請求書合計金額
  var invoiceAmount = document.getElementById('invoiceAmount').value;
  invoiceAmount = taskSum + expencesSum;

  const invoiceAmount_alert = document.getElementById('invoiceAmount_alert');

    if(task_taxIncludedPrice < invoiceAmount){
		invoiceAmount_alert.style.display = 'block';
	}else {
		invoiceAmount_alert.style.display = 'none';
	}
}
var addTaskCnt = 0;
const addtaskRequest = () => {
  addTaskCnt++;
  console.log(addTaskCnt);
  const taskRequest = document.getElementById('taskRequest');
  const inner = `
    <tr>
	  <td class="del-task-record" name="task_element" onclick="delTaskRecord(this)">×</td>
	  <td class="item"><input type="text" name="item_name[]" value="{{ old("item_name.1") }}"></td>
	  <td class="num"><input type="text" name="item_num[]" value="{{ old('item_num.1') }}" onchange="calculateSumPrice(this.value)"></td>
	  <td class="unit-price"><input type="text" name="item_unit_price[]" value="{{ old('item_unit_price.1') }}" onchange="calculateSumPrice(this.value)"><span>円</span></td>
	  <td class="tax">
	    <select name="item_tax[]" onchange="calculateSumPrice(this.value)">	
		  <option name="tax_10" value="1.1" {{ old('item_tax.1') == '1.1' ? 'selected' : '' }}>10%</option>
  		  <option name="tax_8" value="1.08" {{ old('item_tax.1') == '1.08' ? 'selected' : '' }}>軽減8%</option>
	  	  <option name="tax_none" value="1.0" {{ old('item_tax.1') == '1.0' ? 'selected' : '' }}>非課税</option>
	    </select>
	  </td>
	  <td class="total"><p class="task_request_total"></p><span>円</span></td>
	  <input type="hidden" name="item_total[]">
	</tr>`;
  taskRequest.insertAdjacentHTML('beforeend', inner);

  var taskElement = document.querySelectorAll('td.del-task-record');
    taskElement.forEach(function(val, i){
    val.setAttribute('value', (i+1));
  });
}

const addExpences = () => {
  const expences = document.getElementById('expences');
  const inner = `
	  <tr>
	    <td class="del-expences-record" name="expences_element" onclick="delExpenceRecord(this)">×</td>
		<td class="item"><input type="text" name="expences_name[]" value="{{ old('expences_name.1') }}"></td>
		<td class="num"><input type="text" name="expences_num[]" value="{{ old('expences_num.1') }}" onchange="calculateSumPrice(this.value)"></td>
		<td class="unit-price"><input type="text" name="expences_unit_price[]" value="{{ old('expences_unit_price.1') }}" onchange="calculateSumPrice(this.value)"><span>円</span></td>
		<td class="tax">
		  <select name="expences_tax[]" onchange="calculateSumPrice(this.value)">	
			<option name="tax_10" value="1.1" {{ old('expences_tax.1') == '1.1' ? 'selected' : '' }}>10%</option>
			<option name="tax_8" value="1.08" {{ old('expences_tax.1') == '1.08' ? 'selected' : '' }}>軽減8%</option>
			<option name="tax_none" value="1.0" {{ old('expences_tax.1') == '1.0' ? 'selected' : '' }}>非課税</option>
		  </select>
		</td>
		<td class="total"><p class="expence_total"></p><span>円</span></td>
		<input type="hidden" name="expences_total[]">
	  </tr>`;
  expences.insertAdjacentHTML('beforeend', inner);

  var expencesElement = document.querySelectorAll('td.del-expences-record');
    expencesElement.forEach(function(val, i){
    val.setAttribute('value', (i+1));
  });
}

// 担当者が選択された場合、担当者(自由記入)の記入不可へ 
function selectStaff() {
	var free_staff_name = document.getElementById('free_staff_name');
	free_staff_name.disabled = true;
}
// 担当者selectbox未選択状態へ
function setNonSelect(idname){
	var selectedStaff = document.getElementById(idname);
	selectedStaff.selectedIndex = -1;
	free_staff_name.disabled = false;
}
// 担当者(自由記入) input記入不可状態へ
function billingText(){
	var input_staff_name = document.getElementById('free_staff_name').value;
	if(input_staff_name != "") {
		staff_name.disabled = true;
	} else {
		staff_name.disabled = false;
	}
}
// taskレコード削除
function delTaskRecord(button) {
	var parent = button.parentNode;
	parent.remove(parent);
	calculateSumPrice();
}
// expencesレコード削除
function delExpenceRecord(button) {
	var parent = button.parentNode;
	parent.remove(parent);
	calculateSumPrice();
}

window.onload = () => {
  var taskCount = document.getElementById('task_count').value;
  for (i = 0; i < taskCount - 1; i++) {
	addtaskRequest();
  }

  var expencesCount = document.getElementById('expences_count').value;
  for (i = 0; i < expencesCount - 1; i++) {
    addExpences();
  }

  calculateSumPrice();
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

	@if(!$partner_invoice)
		<div class="error-container">
			<p>
				請求情報が未登録のため、請求情報を登録してください。
				<a href="{{ route('partner.setting.invoice.create') }}">登録はこちら</a>
			</p>
		</div>
	@endif

	<div class="title-container">
		<h3>請求書作成</h3>
	</div>

	<form action="{{ route('partner.invoice.store') }}" method="POST">
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
								 	@else
									<option value="{{ $companyUser->id }}" {{ $task->companyUser->id === $companyUser->id ? 'selected' : '' }}>{{ $companyUser->name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<input type="button" value="×" onclick="setNonSelect('staff_name');">
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
						<input class="free-staff-name" type="text" name="billing_to_text" id="free_staff_name" disabled onchange="billingText();">
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
						<input class="task-name" type="text" name="title" value="{{ old('title', $task->name . 'のご請求') }}">
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
								type="date"
								name="requested_at"
								value="{{ old('started_at', date('Y-m-d')) }}"
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
						<div class="radio-container">
							<span id="deadline_at_text"></span>
							<input
								type="date"
								name="deadline_at"
								value="{{ old('deadline_at') }}"
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
						<tr>
							<td class="del-task-record" name="task_element" onclick="delTaskRecord(this)">×</td>
							<td class="item"><input type="text" name="item_name[]" value="{{ old('item_name.0') }}"></td>
							<td class="num"><input type="text" name="item_num[]" value="{{ old('item_num.0') }}" onchange="calculateSumPrice(this.value)"></td>
							<td class="unit-price"><input type="text" name="item_unit_price[]" value="{{ old('item_unit_price.0') }}" onchange="calculateSumPrice(this.value)"><span>円</span></td>
							<td class="tax">
                                <div class="selectbox-container">
                                    <select name="item_tax[]" onchange="calculateSumPrice(this.value)">	
                                        <option name="tax_10" value="1.1" {{ old('item_tax.0') == '1.1' ? 'selected' : '' }}>10%</option>
                                        <option name="tax_8" value="1.08" {{ old('item_tax.0') == '1.08' ? 'selected' : '' }}>軽減8%</option>
                                        <option name="tax_none" value="1.0" {{ old('item_tax.0') == '1.0' ? 'selected' : '' }}>非課税</option>
                                    </select>
                                </div>
							</td>
							<td class="total"><p class="task_request_total"></p><span>円</span></td>
							<input type="hidden" name="item_total[]">
							<input type="hidden" id="task_count" value="{{ $task_count }}">
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
							<th class="del-record"></th>
							<th class="item">品目</th>
							<th class="num">数</th>
							<th class="unit-price">単価</th>
							<th class="tax">税区分</th>
							<th class="total">合計金額</th>
						</tr>
					</thead>
					
					<tbody id="expences">
						<tr>
							<td class="del-expences-record" name="expences_element" onclick="delExpenceRecord(this)">×</td>
							<td class="item"><input type="text" name="expences_name[]" value="{{ old('expences_name.0') }}"></td>
							<td class="num"><input type="text" name="expences_num[]" value="{{ old('expences_num.0') }}" onchange="calculateSumPrice(this.value)"></td>
							<td class="unit-price"><input type="text" name="expences_unit_price[]" value="{{ old('expences_unit_price.0') }}" onchange="calculateSumPrice(this.value)"><span>円</span></td>
							<td class="tax">
								<div class="selectbox-container">
									<select name="expences_tax[]" onchange="calculateSumPrice(this.value)">	
										<option name="tax_10" value="1.1" {{ old('item_tax.0') == '1.1' ? 'selected' : '' }}>10%</option>
										<option name="tax_8" value="1.08"  {{ old('item_tax.0') == '1.08' ? 'selected' : '' }}>軽減8%</option>
										<option name="tax_none" value="1.0"  {{ old('item_tax.0') == '1.0' ? 'selected' : '' }}>非課税</option>
									</select>
								</div>
							</td>
							<td class="total"><p class="expence_total"></p><span>円</span></td>
							<input type="hidden" name="expences_total[]">
							<input type="hidden" id="expences_count" value="{{ $expences_count }}">
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
			<button type="button" onclick="submit();">作成</button>
		</div>
	</form>
</div>
@endsection

@section('asset-js')
<script>

</script>
@endsection
