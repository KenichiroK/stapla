@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>発注書作成</h3>
	</div>

	<form action="{{ route('company.document.purchaseOrder.store') }}" method="POST">
		@csrf
		<div class="purchaseOrder-container">
			
			<div class="form-container">
				<dl>
					<dt>タスク</dt>
					<dd>
                        <p>{{ $task->name }}</p>
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
					</dd>
                </dl>
                
                <dl>
                    <dt>件名</dt>
                    <dd>
						<div class="input-container">
							<input class="task-name" type="text" name="task_name" value="{{ old('task_name', $task->name) }}">
						</div>
                        @if ($errors->has('task_name'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('task_name') }}</strong>
                            </div>					
                        @endif
                    </dd>
                </dl>

                <dl>
					<dt>納品日</dt>
					<dd>
					<div class="date-container">
						<div class="date-container__wrapper">
							<div class="text">納品日</div> 
							<div class="icon-imgbox">
								<img src="{{ env('AWS_URL') }}/common/icon_calendar.png" alt="">
							</div>
							<div class="radio-container">
							<!-- <span id="deadline_at_text"></span> -->
							<label for="end_of_next_month">
								<span class="title">来月末にする</span> 
								<input
									class="radio-input radio01-input"
									type="radio" 
									name="task_ended_at" 
									value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) }}" 
									id="end_of_next_month" 
									onclick="checkDeadline()"
									{{ old('task_ended_at') === date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) ? 'checked' : '' }}
								>
								<span class="radio01-parts"></span>
							</label>
							<label for="end_of_month_after_next">
								<span class="title">再来月末にする</span>
								<input
									class="radio-input radio01-input" 
									type="radio" 
									name="task_ended_at" 
									value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) }}" 
									id="end_of_month_after_next" 
									onclick="checkDeadline()"
									{{ old('task_ended_at') === date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) ? 'checked' : '' }}
								>
								<span class="radio01-parts"></span>
							</label>
						</div>
						
						</div>
						@if ($errors->has('task_ended_at'))
							<div class="error-msg">
								<strong>{{ $errors->first('task_ended_at') }}</strong>
							</div>					
						@endif
						
					</div>
						
					</dd>
                </dl>
                
                <dl>
					<dt>納品場所</dt>
					<dd>
						<div class="input_link-container">
							<div class="input-container">
								<input class="task-name" type="text" name="task_delivery_format" value="{{ old('task_delivery_format') }}">
							</div>
							<!-- <div class="link-container">
								<a href="">データによる送付</a>
							</div> -->
						</div>
						@if ($errors->has('task_delivery_format'))
							<div class="error-msg">
								<strong>{{ $errors->first('task_delivery_format') }}</strong>
							</div>					
						@endif
					</dd>
				</dl>
				
				<!-- <dl>
					<dt>支払い条件</dt>
					<dd>
						<div class="input_link-container">
							<div class="input-container">
								<input class="task-name" type="text" name="task_delivery_format" value="{{ old('task_delivery_format') }}">
							</div>
							<div class="link-container">
								<a href="">等月末締め翌月払い</a>
							</div>
						</div>
						@if ($errors->has('task_delivery_format'))
							<div class="error-msg">
								<strong>{{ $errors->first('task_delivery_format') }}</strong>
							</div>					
						@endif
					</dd>
                </dl> -->
                
                <dl>
					<dt>担当者</dt>
					<dd>
						<div class="select-container">
                            <div class="select-container__wrapper select-plusicon">
								<select name="companyUser_id">
									<option value="" hidden></option>
									@foreach($task->taskCompanies as $companyUser)
										<option value="{{ $companyUser->companyUser->id }}" {{ old('companyUser_id') === $companyUser->companyUser->id ? 'selected' : ''}}>{{ $companyUser->companyUser->name }}</option>
									@endforeach
								</select>
							</div>
                        </div>
						@if ($errors->has('companyUser_id'))
							<div class="error-msg">
								<strong>{{ $errors->first('companyUser_id') }}</strong>
							</div>					
						@endif
					</dd>
                </dl>
                
                <dl>
                    <dt>パートナー</dt>
                    <dd>
                        <p>{{ $task->partner->name }}</p>
                        <input type="hidden" name="partner_id"  value="{{ $task->partner_id }}">
					</dd>
                </dl>

			</div>
		</div>

		<div class="btn02-container">
			<button type="button" onclick="submit();">作成</button>
		</div>
    </form>
    
</div>
@endsection
