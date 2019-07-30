@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/index.css') }}">
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
  let taskNums = document.getElementsByName('task_num');
  let taskUnitPrices = document.getElementsByName('task_unit_price');
  let expencesNums = document.getElementsByName('expences_num');
  let expencesUnitPrices = document.getElementsByName('expences_unit_price');
  let taskSum = 0;
  let expencesSum = 0;
  for (i = 0; i < taskNums.length; i++) {
	taskNums[i].value = taskNums[i].value === undefined ? 0 : Number(taskNums[i].value);
	taskUnitPrices[i].value = taskUnitPrices[i].value === undefined ? 0 : Number(taskUnitPrices[i].value);
	taskSum += taskNums[i].value * taskUnitPrices[i].value;
  }

  for (i = 0; i < expencesNums.length; i++) {
	expencesNums[i].value = expencesNums[i].value === undefined ? 0 : Number(expencesNums[i].value);
	expencesUnitPrices[i].value = expencesUnitPrices[i].value === undefined ? 0 : Number(expencesUnitPrices[i].value);
	expencesSum += expencesNums[i].value * expencesUnitPrices[i].value;
  }
  sum.textContent = `￥${(taskSum + expencesSum).toLocaleString()}`;
}
</script>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    impro
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
                <li>
					<form method="POST" action="{{ route('company.logout') }}">
						@csrf
						<button type="submit">ログアウト</button>
					</form>
				</li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>発注書作成</h3>
	</div>

	<form action="{{ url('company/document/purchaseOrder') }}" method="POST">
		@csrf
		<div class="invoice-container">
			
			<div class="form-container">
				<dl>
					<dt>タスク</dt>
					<dd>
						<div class="selectbox-container">
							<select name="task_id">
								<option value="" hidden></option>
								@foreach($tasks as $task)
									<option value="{{ $task->id }}">{{ $task->name }}</option>
								@endforeach
								@if ($errors->has('task_id'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('task_id') }}</strong>
									</div>					
								@endif
							</select>
						</div>
					</dd>
                </dl>
                
                <dl>
                    <dt>件名</dt>
                    <dd>
                        <input class="task-name" type="text" name="task_name" value="{{ old('task_name') }}">
                        @if ($errors->has('task_name'))
                            <div>
                                <strong style='color: #e3342f;'>{{ $errors->first('task_name') }}</strong>
                            </div>					
                        @endif
                    </dd>
                </dl>

                <dl>
					<dt>納品日</dt>
					<dd>
						<div class="radio-container">
							<span id="deadline_at_text"></span>
							<input class="radio-input" type="radio" name="task_ended_at" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) }}" id="end_of_next_month" onclick="checkDeadline()">
							<label for="end_of_next_month">来月末にする</label>
							<input class="radio-input" type="radio" name="task_ended_at" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) }}" id="end_of_month_after_next" onclick="checkDeadline()">
							<label for="end_of_month_after_next">再来月末にする</label>
						</div>
						@if ($errors->has('task_ended_at'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('task_ended_at') }}</strong>
							</div>					
						@endif
					</dd>
                </dl>
                
                <dl>
					<dt>納品場所</dt>
					<dd>
						<input class="task-name" type="text" name="task_delivery_format" value="{{ old('task_delivery_format') }}">
						@if ($errors->has('task_name'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('task_delivery_format') }}</strong>
							</div>					
						@endif
					</dd>
                </dl>
                
                <dl>
					<dt>担当者</dt>
					<dd>
						<div class="selectbox-container">
							<select name="companyUser_id">
								<option value="" hidden></option>
								@foreach($companyUsers as $companyUser)
									<option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
								@endforeach
								@if ($errors->has('companyUser_id'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('companyUser_id') }}</strong>
									</div>					
								@endif
							</select>
						</div>
					</dd>
                </dl>
                
                <dl>
                    <dt>パートナー</dt>
                    <dd>
						<div class="selectbox-container">
							<select name="partner_id">
								<option value="" hidden></option>
								@foreach( $tasks as $task )
									@foreach( $task->taskPartners as $taskPartners )
									<option value="{{ $taskPartners->partner->id }}">{{ $taskPartners->partner->name }}</option>
									@endforeach
								@endforeach
								@if ($errors->has('partner_id'))
									<div>
										<strong style='color: #e3342f;'>{{ $errors->first('partner_id') }}</strong>
									</div>					
								@endif
							</select>
						</div>
					</dd>
                </dl>

			</div>

		<div class="button-container">
			<button type="submit">作成</button>
		</div>
	</form>
</div>
@endsection