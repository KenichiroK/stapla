@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/index.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="{{ asset('images/icon_small-down.png') }}" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection


@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_home.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_dashboard.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document" class="isActive">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_invoices.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_customers.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_help-center.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_setting.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            設定
                        </div>
                    </a>
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
		<div class="purchaseOrder-container">
			
			<div class="form-container">
				<dl>
					<dt>タスク</dt>
					<dd>
						<p>{{ $task->name }}</p>
					</dd>
                </dl>
                
                <dl>
                    <dt>件名</dt>
                    <dd>
						<div class="input-container">
							<input class="task-name" type="text" name="task_name" value="{{ old('task_name') }}">
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
								<img src="{{ asset('images/icon_calendar.png') }}" alt="">
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
					</dd>
                </dl>

			</div>
		</div>

		<div class="button-container">
			<button type="submit">作成</button>
		</div>
	</form>
</div>
@endsection
