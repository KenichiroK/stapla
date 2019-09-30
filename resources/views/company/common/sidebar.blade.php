<div class="sidebar__container">
	<div class="sidebar__container__wrapper">
		<aside class="menu menu__container">
			<a href="/company/dashboard">
				<div class="menu__container--label">
					<div class="menu-label">
						<img src="{{ asset('images/logo.png') }}" alt="logo">
					</div>
				</div>
			</a>
			<ul class="menu-list menu menu__container__menu-list">
				<li>
					<a href="{{ route('company.dashboard') }}" class="{{ strpos(request()->route()->getName(), 'dashboard') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ asset('images/icon_dashboard-active.png') }}" alt="">
						</div>
						<div class="textbox">
							ダッシュボード
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('company.project.index') }}" class="{{ strpos(request()->route()->getName(), 'project') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ asset('images/icon_inbox.png') }}" alt="">
						</div>
						<div class="textbox">
							プロジェクト
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('company.task.index') }}" class="{{ strpos(request()->route()->getName(), 'task') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ asset('images/icon_products.png') }}" alt="">
						</div>
						<div class="textbox">
							タスク
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('company.document.index') }}" class="{{ strpos(request()->route()->getName(), 'document') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ asset('images/icon_invoices.png') }}" alt="">
						</div>
						<div class="textbox">
							書類
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('company.partner.index') }}" class="{{ strpos(request()->route()->getName(), 'partner') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ asset('images/icon_customers.png') }}" alt="">
						</div>
						<div class="textbox">
							パートナー
						</div>
					</a>
				</li>
				<!-- <li>
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
				</li> -->
				<li>
					<a href="{{ route('company.setting.general.create') }}" class="{{ strpos(request()->route()->getName(), 'setting') ? 'isActive' : '' }}">
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
