@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/companyElse/index.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('preview');
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      console.log(e)
      preview.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
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

@section('content');
<div class="main-wrapper">
    @if ($completed)
		<div class="complete-container">
			<p>{{ $completed }}</p>
		</div>
		@endif

		@if(count($errors) > 0)
		<div class="error-container">
			<p>入力に問題があります。再入力して下さい。</p>
		</div>
	@endif
	<div class="title-container">
		<h3>会社その他設定</h3>
    </div>
	<div class="menu-container">
		<ul>
			<li><a href="/company/setting/general">会社基本情報設定</a></li>
			<li><a href="/company/setting/companyElse" class="isActive">会社その他の設定</a></li>
			<li><a href="/company/setting/userSetting">会社担当者設定</a></li>
			<li><a href="/company/setting/personal">アカウント設定</a></li>
			<li><a href="/company/setting/personal">個人情報の設定</a></li>
		</ul>
    </div>
    <form action="{{ url('company/setting/companyElse') }}" method="POST">
		@csrf
		<div class="notification-container">
			<div class="title-container">
				<h4>会社情報のその他設定</h4>
			</div>

			<div class="radio-container">
                <p class="text">上長、経理による書類・タスクの承認</p>
                @if ($company && $company->approval_setting == true)
                    <input type="radio" name="approval_setting" value="1" id="approval_true" checked>
                    <label class="left-btn" for="approval_true">有効</label>
                    <input type="radio" name="approval_setting" value="0" id="approval_false">
                    <label for="approval_false">無効</label>
                @elseif ($company && $company->approval_setting == false)
                    <input type="radio" name="approval_setting" value="1" id="approval_true">
                    <label class="left-btn" for="approval_true">有効</label>
                    <input type="radio" name="approval_setting" value="0" id="approval_false" checked>
                    <label for="approval_false">無効</label>
                @else ($company && $company->approval_setting == true)
                    <input type="radio" name="approval_setting" value="1" id="approval_true">
                    <label class="left-btn" for="approval_true">有効</label>
                    <input type="radio" name="approval_setting" value="0" id="approval_false">
                    <label for="approval_false">無効</label>
                @endif
			</div>

			<div class="radio-container">
				<p class="text">請求書の源泉所得税の有無</p>
				<p class="sub-text">請求書作成時に、経費を源泉徴収の対象にするかどうか選択できます。</p>
                @if ($company && $company->income_tax_setting == true)
                    <input type="radio" name="income_tax_setting" value="1" id="income_true" checked>
                    <label class="left-btn" for="income_true">有効</label>
                    <input type="radio" name="income_tax_setting" value="0" id="income_false">
                    <label for="income_false">無効</label>
                @elseif ($company && $company->income_tax_setting == false)
                    <input type="radio" name="income_tax_setting" value="1" id="income_true">
                    <label class="left-btn" for="income_true">有効</label>
                    <input type="radio" name="income_tax_setting" value="0" id="income_false" checked>
                    <label for="income_false">無効</label>
                @else ($company && $company->income_tax_setting == true)
                    <input type="radio" name="income_tax_setting" value="1" id="income_true">
                    <label class="left-btn" for="income_true">有効</label>
                    <input type="radio" name="income_tax_setting" value="0" id="income_false">
                    <label for="income_false">無効</label>
                @endif
			</div>

			<div class="radio-container">
				<p class="text">リマインド設定</p>
				<p class="sub-text">締め日を有効にし登録すると、締め日に「申請されていない請求書」「請求書に紐づけられていないタスク」がある場合、自動通知が行なわれます。</p>
                @if ($company && $company->remind_setting == true)
                    <input type="radio" name="remind_setting" value="1" id="remind_true" checked>
                    <label class="left-btn" for="remind_true">有効</label>
                    <input type="radio" name="remind_setting" value="0" id="remind_false">
                    <label for="remind_false">無効</label>
                @elseif ($company && $company->remind_setting == false)
                    <input type="radio" name="remind_setting" value="1" id="remind_true">
                    <label class="left-btn" for="remind_true">有効</label>
                    <input type="radio" name="remind_setting" value="0" id="remind_false" checked>
                    <label for="remind_false">無効</label>
                @else ($company && $company->income_tax_setting == true)
                    <input type="radio" name="remind_setting" value="1" id="remind_true">
                    <label class="left-btn" for="remind_true">有効</label>
                    <input type="radio" name="remind_setting" value="0" id="remind_false">
                    <label for="remind_false">無効</label>
                @endif
			</div>
            <div style="display:flex">
                <div style="margin-right: 16px">
                    毎月
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">15</option>
                        <option value="">20</option>
                    </select>
                    日締め
                </div>
                <div style="display:flex; margin-right: 16px">
                    <div style="margin-right: 16px">
                        <div class="other-info-container__list__item__date-container__wrapper__heading">次回締め日</div>
                        <div>2019年2月28日</div>
                    </div>
                    <div style="margin-right: 16px">
                        <div class="other-info-container__list__item__date-container__wrapper__heading">タスク通知日</div>
                        <div>2019年2月25日</div>
                    </div>
                    <div style="margin-right: 16px">
                        <div class="other-info-container__list__item__date-container__wrapper__heading">請求書通知日</div>
                        <div>2019年2月27日</div>
                    </div>
                </div>           
            </div>
            <div class="title-container">
				<h4>会社情報のその他設定</h4>
			</div>
            <div class="other-info-container__list__item__menu">
                <div>
                    <div class="radio-container">
                        <p class="text">発注書</p>
                        @if ($company && $company->purchase_order_setting == true)
                            <input type="radio" name="purchase_order_setting" value="1" id="purchase_true" checked>
                            <label class="left-btn" for="purchase_true">有効</label>
                            <input type="radio" name="purchase_order_setting" value="0" id="purchase_false">
                            <label for="purchase_false">無効</label>
                        @elseif ($company && $company->purchase_order_setting == false)
                            <input type="radio" name="purchase_order_setting" value="1" id="purchase_true">
                            <label class="left-btn" for="purchase_true">有効</label>
                            <input type="radio" name="purchase_order_setting" value="0" id="purchase_false" checked>
                            <label for="purchase_false">無効</label>
                        @else ($company && $company->purchase_order_setting == true)
                            <input type="radio" name="purchase_order_setting" value="1" id="purchase_true">
                            <label class="left-btn" for="purchase_true">有効</label>
                            <input type="radio" name="purchase_order_setting" value="0" id="purchase_false">
                            <label for="purchase_false">無効</label>
                        @endif
                    </div>
                    <div class="form-select-container__drag-drop">drag&drop</div>
                </div>
                <div>
                    <div class="radio-container">
                        <p class="text">機密保持契約書</p>
                        @if ($company && $company->confidential_setting == true)
                            <input type="radio" name="confidential_setting" value="1" id="confidential_true" checked>
                            <label class="left-btn" for="confidential_true">有効</label>
                            <input type="radio" name="confidential_setting" value="0" id="confidential_false">
                            <label for="confidential_false">無効</label>
                        @elseif ($company && $company->confidential_setting == false)
                            <input type="radio" name="confidential_setting" value="1" id="confidential_true">
                            <label class="left-btn" for="confidential_true">有効</label>
                            <input type="radio" name="confidential_setting" value="0" id="confidential_false" checked>
                            <label for="confidential_false">無効</label>
                        @else ($company && $company->confidential_setting == true)
                            <input type="radio" name="confidential_setting" value="1" id="confidential_true">
                            <label class="left-btn" for="confidential_true">有効</label>
                            <input type="radio" name="confidential_setting" value="0" id="confidential_false">
                            <label for="confidential_false">無効</label>
                        @endif
                    </div>
                    <div class="form-select-container__drag-drop">drag&drop</div>
                </div>
            </div>
		</div>

		<div class="btn-container">
			<button type="submit">設定</button>
		</div>
	</form>
</div>
@endsection