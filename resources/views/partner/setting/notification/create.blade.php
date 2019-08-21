@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/setting/notification/index.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $partner->name }}
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
                    <form method="POST" action="{{ route('partner.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <a href="/partner/profile">
            <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
        </a>
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/partner/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/partner/setting/invoice" class="isActive">
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
		<h3>設定</h3>
	</div>

	<div class="menu-container">
		<ul>
			<li><a href="/partner/setting/invoice">請求情報設定</a></li>
			<li><a href="#">メールアドレス・パスワード設定</a></li>
			<li><a href="/partner/setting/notification" class="isActive">通知設定</a></li>
			<li><a href="#">個人情報の設定</a></li>
		</ul>
	</div>

	<form action="{{ url('partner/setting/notification') }}" method="POST">
		@csrf
		<div class="notification-container">
			<div class="title-container">
				<h4>通知設定</h4>
			</div>

			<div class="radio-container">
				<p class="text">通知メールの受信</p>
				<p class="sub-text">タスクや請求書のアクティビティログの通知をメールをお知らせします。</p>
				@if ($setting && $setting->email_notification == true)
					<input type="radio" name="email_notification" value="1" id="email_true" checked>
					<label class="left-btn" for="email_true">有効</label>
					<input type="radio" name="email_notification" value="0" id="email_false">
					<label for="email_false">無効</label>
				@elseif ($setting && $setting->email_notification == false)
					<input type="radio" name="email_notification" value="1" id="email_true">
					<label class="left-btn" for="email_true">有効</label>
					<input type="radio" name="email_notification" value="0" id="email_false" checked>
					<label for="email_false">無効</label>
				@else
					<input type="radio" name="email_notification" value="1" id="email_true">
					<label class="left-btn" for="email_true">有効</label>
					<input type="radio" name="email_notification" value="0" id="email_false">
					<label for="email_false">無効</label>
				@endif
				@if ($errors->has('email_notification'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('email_notification') }}</strong>
					</div>					
				@endif
			</div>

			<div class="radio-container">
				<p class="text">デイリーメールの受信</p>
				<p class="sub-text">毎朝、期限切れのタスクがある場合にメールを送ります。</p>
				@if ($setting && $setting->daily_mail == true)
					<input type="radio" name="daily_mail" value="1" id="daily_true" checked>
					<label class="left-btn" for="daily_true">有効</label>
					<input type="radio" name="daily_mail" value="0" id="daily_false">
					<label for="daily_false">無効</label>
				@elseif ($setting && $setting->daily_mail == false)
					<input type="radio" name="daily_mail" value="1" id="daily_true">
					<label class="left-btn" for="daily_true">有効</label>
					<input type="radio" name="daily_mail" value="0" id="daily_false" checked>
					<label for="daily_false">無効</label>
				@else
					<input type="radio" name="daily_mail" value="1" id="daily_true">
					<label class="left-btn" for="daily_true">有効</label>
					<input type="radio" name="daily_mail" value="0" id="daily_false">
					<label for="daily_false">無効</label>
				@endif
				@if ($errors->has('daily_mail'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('daily_mail') }}</strong>
					</div>					
				@endif
			</div>

			<div class="radio-container last">
				<p class="text">Slack連携</p>
				<p class="sub-text">Slackと連携すると、improからの通知がSlackに届きます。</p>
				@if ($setting && $setting->slack == true)
					<input type="radio" name="slack" value="1" id="slack_true" checked>
					<label class="left-btn" for="slack_true">有効</label>
					<input type="radio" name="slack" value="0" id="slack_false">
					<label for="slack_false">無効</label>
				@elseif ($setting && $setting->slack == false)
					<input type="radio" name="slack" value="1" id="slack_true">
					<label class="left-btn" for="slack_true">有効</label>
					<input type="radio" name="slack" value="0" id="slack_false" checked>
					<label for="slack_false">無効</label>
				@else
					<input type="radio" name="slack" value="1" id="slack_true">
					<label class="left-btn" for="slack_true">有効</label>
					<input type="radio" name="slack" value="0" id="slack_false">
					<label for="slack_false">無効</label>
				@endif
				@if ($errors->has('slack'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('slack') }}</strong>
					</div>					
				@endif
			</div>
		</div>

		<div class="btn-container">
			<button type="submit">設定</button>
		</div>
	</form>
</div>
@endsection
