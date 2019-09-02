@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/invoice/show.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="../../../images/icon_small-down.png" alt="">
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
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-home"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <!-- <i class="fas fa-chart-bar"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <!-- <i class="fas fa-envelope"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <!-- <i class="fas fa-tasks"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document" class="isActive">
                        <!-- <i class="fas fa-newspaper"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <!-- <i class="fas fa-user-circle"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-calendar-alt"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-question"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <!-- <i class="fas fa-cog"></i> -->
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
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
		<h3>請求書プレビュー</h3>
		<button id="print_btn" type="button">プリント</button>
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
                        <p>発注日: {{ $invoice->requested_at }}</p>
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
                                <p>{{ number_format($total_sum / 1.08) }}</p>
                            @endif
                        </div>
        
                        <div class="section-container">
                            <p class="sub-column">消費税</p>
                            @if ($invoice->tax === 0)
                                <p>{{ number_format($total_sum * 0.08) }}</p>
                            @else
                                <p>{{ number_format($total_sum / 1.08 * 0.08) }}</p>
                            @endif
                        </div>
        
                        <div class="section-container">
                            <p class="sub-column">総額</p>
                            @if ($invoice->tax === 0)
                                <p class="total-text">{{ number_format($total_sum * 1.08) }}</p>
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
                        <p>ご入金期限: {{ $invoice->deadline_at }}</p>
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
					<p>発注日: {{ $invoice->requested_at }}</p>
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
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                        <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                        <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                        <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                        <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                        <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
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
							<p>{{ number_format($total_sum / 1.08) }}</p>
						@endif
					</div>
	
					<div class="section-container">
						<p class="sub-column">消費税</p>
						@if ($invoice->tax === 0)
							<p>{{ number_format($total_sum * 0.08) }}</p>
						@else
							<p>{{ number_format($total_sum / 1.08 * 0.08) }}</p>
						@endif
					</div>
	
					<div class="section-container">
						<p class="sub-column">総額</p>
						@if ($invoice->tax === 0)
							<p class="total-text">{{ number_format($total_sum * 1.08) }}</p>
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
					<p>ご入金期限: {{ $invoice->deadline_at }}</p>
				</div>
	
				<div class="content-container">
					<p>お振込み先: {{ $partner->partnerInvoice->account_holder }}</p>
					<p>{{ $partner->partnerInvoice->financial_institution }} {{ $partner->partnerInvoice->branch }} ({{ $partner->partnerInvoice->deposit_type }}) {{ $partner->partnerInvoice->account_number }}</p>
				</div>
			</div>
		</div>
	</div>
​
	@if($task->status === 12 && in_array($company_user->id, $company_user_ids))
	<div class="actiionButton">
		<form action="{{ url('company/task/status') }}" method="POST">
		@csrf
			<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
			<input type="hidden" name="status" value="11">
			<div class="button-container">
				<button class="undone" type="submit">請求書を拒否する</button>
			</div>
		</form>
		<form action="{{ url('company/task/status')}}" method="POST">
		@csrf
			<input type="hidden" name="task_id" value="{{ $invoice->task->id }}">
			<input type="hidden" name="status" value="13">
			<div class="button-container">
				<button class="done" type="submit">請求書を承認する</button>
			</div>
		</form>
	</div>
	@elseif($task->status > 12 && in_array($company_user->id, $company_user_ids))
	<p class="send-done">この請求書は承認済みです</p>
	@else
	<p class="send-done">必要なアクションはありません</p>
	@endif
</div>
@endsection

@section('pdf-js')
    <script src="{{ asset('js/pdf.js') }}" defer></script>
@endsection
