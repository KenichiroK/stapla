@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/invoice/index.css') }}">
<script>
const checkInvoiceDate = () => {
  const invoiceDateRadio = document.getElementsByName('invoice_date');
  const invoiceDateText = document.getElementById('invoice_date_text');
  if (invoiceDateRadio[0].checked) {
	const dateArr = invoiceDateRadio[0].value.split('-');
	invoiceDateText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  } else if (invoiceDateRadio[1].checked) {
    const dateArr = invoiceDateRadio[1].value.split('-');
	invoiceDateText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  }
}

const checkDeadline = () => {
  const deadlineRadio = document.getElementsByName('deadline');
  const deadlineText = document.getElementById('deadline_text');
  if (deadlineRadio[0].checked) {
	const dateArr = deadlineRadio[0].value.split('-');
	deadlineText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  } else if (deadlineRadio[1].checked) {
    const dateArr = deadlineRadio[1].value.split('-');
	deadlineText.textContent = `${dateArr[0]}年${dateArr[1]}月${dateArr[2]}日`;
  }
}
</script>
@endsection

@section('header-profile')
<div class="navbar-item">
    user name
</div>
<div class="navbar-item">
    <a href="/partner/profile">
        <img src="/storage/images/default/dummy_user.jpeg" alt="プロフィール画像">
    </a>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/partner/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/partner/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/partner/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/invoice/create" class="isActive"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/partner/setting/invoice"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('partner.logout') }}">
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
		<h3>請求書作成</h3>
	</div>

	<form action="{{ url('partner/invoice') }}" method="POST">
		@csrf
		<div class="invoice-container">
			<div class="invoiceTo-container">
				<dl>
					<dt>請求先</dt>
					<dd>株式会社◯◯◯◯</dd>
				</dl>

				<dl>
					<dt>住所</dt>
					<dd>〒000-0000 東京都千代田区千代田1-1-1</dd>
				</dl>
			</div>
			
			<div class="form-container">
				<dl>
					<dt>担当者</dt>
					<dd>
						<div class="selectbox-container">
							<select name="companyUser_id">
								<option value="" hidden></option>
								<option value="">山田 太郎</option>
								<option value="">山田 花子</option>
								<option value="">鈴木 一郎</option>
							</select>
						</div>
					</dd>
				</dl>

				<dl>
					<dt>件名</dt>
					<dd>
						<input class="task-name" type="text" name="task_name" value="{{ old('task_name') }}">
					</dd>
				</dl>

				<dl>
					<dt>請求日</dt>
					<dd>
						<div class="radio-container">
							<span id="invoice_date_text"></span>
							<input class="radio-input" type="radio" name="invoice_date" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y'))) }}" id="end_of_last_month" onclick="checkInvoiceDate()">
							<label for="end_of_last_month">先月末にする</label>
							<input class="radio-input" type="radio" name="invoice_date" value="{{ date('Y-m-t') }}" id="end_of_this_month" onclick="checkInvoiceDate()">
							<label for="end_of_this_month">今月末にする</label>
						</div>
					</dd>
					
				</dl>

				<dl>
					<dt>支払い期限</dt>
					<dd>
						<div class="radio-container">
							<span id="deadline_text"></span>
							<input class="radio-input" type="radio" name="deadline" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) }}" id="end_of_next_month" onclick="checkDeadline()">
							<label for="end_of_next_month">来月末にする</label>
							<input class="radio-input" type="radio" name="deadline" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))) }}" id="end_of_month_after_next" onclick="checkDeadline()">
							<label for="end_of_month_after_next">再来月末にする</label>
						</div>
					</dd>
				</dl>

				<dl>
					<dt>消費税</dt>
					<dd>
						<input class="radio-input" type="radio" name="tax" value="1" id="include_tax">
						<label for="include_tax">税込表示</label>
						<input class="radio-input"  type="radio" name="tax" value="2" id="not_include_tax">
						<label for="not_include_tax">税別表示 (8%)</label>
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
					
					<tbody>
						<tr>
							<td class="item"><input type="text" name="task_item" value="{{ old('task_item') }}"></td>
							<td class="num"><input type="text" name="task_num" value="{{ old('task_num') }}"></td>
							<td class="unit-price"><input type="text" name="task_unit_price" value="{{ old('task_unit_price') }}"><span>円</span></td>
							<td class="total"><input type="text" name="task_total" value="{{ old('task_total') }}"><span>円</span></td>
						</tr>
					</tbody>

				</table>
				<div class="addButton-container">
					<button type="button">タスクを追加</button>
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
					
					<tbody>
						<tr>
							<td class="item"><input type="text" name="expences_item" value="{{ old('expences_item') }}"></td>
							<td class="num"><input type="text" name="expences_num" value="{{ old('expences_num') }}"></td>
							<td class="unit-price"><input type="text" name="expences_unit_price" value="{{ old('expences_unit_price') }}"><span>円</span></td>
							<td class="total"><input type="text" name="expences_total" value="{{ old('expences_total') }}"><span>円</span></td>
						</tr>
					</tbody>

				</table>
				<div class="addButton-container">
					<button type="button">経費を追加</button>
				</div>
			</div>

			<div class="total-container">
				<p class="head">請求額</p>
				<div class="sum-container">
					<p><span>税込</span>￥300,000,000</p>
				</div>
			</div>
		</div>

		<div class="button-container">
			<button type="submit">作成</button>
		</div>
	</form>
</div>
@endsection
