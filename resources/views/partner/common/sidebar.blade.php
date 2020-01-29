 <div class="sidebar__container">
	<div class="sidebar__container__wrapper">
		<aside class="menu menu__container">
			<a href="{{ route('partner.dashboard') }}">
				<div class="menu__container--label">
					<div class="menu-label">
						<img src="{{ env('AWS_URL') }}/common/logo.png" alt="logo">
					</div>
				</div>
			</a>

			{{-- HACK: DRYじゃないところ --}}
			@if (Route::currentRouteName() === "partner.notContract")
			<ul class="menu-list menu menu__container__menu-list">
				<li>
					<a href="#" style="pointer-events: none; color: gray;">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_dashboard-active.png" alt="">
						</div>
						<div class="textbox">
							ダッシュボード
						</div>
					</a>
				</li>
				<li>
					<a href="#" style="pointer-events: none; color: gray;">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_inbox.png" alt="">
						</div>
						<div class="textbox">
							プロジェクト
						</div>
					</a>
				</li>
				<li>
					<a href="#" style="pointer-events: none; color: gray;">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_products.png" alt="">
						</div>
						<div class="textbox">
							タスク
						</div>
					</a>
				</li>
				<li>
					<a href="#" style="pointer-events: none; color: gray;">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_invoices.png" alt="">
						</div>
						<div class="textbox">
							書類
						</div>
					</a>
				</li>
				<li>
					<a href="#" style="pointer-events: none; color: gray;">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_setting.png" alt="">
						</div>
						<div class="textbox">
							設定
						</div>
					</a>
				</li>
			</ul>
			@else
			<ul class="menu-list menu menu__container__menu-list">
				<li>
					<a href="{{ route('partner.dashboard') }}" class="{{ strpos(request()->route()->getName(), 'dashboard') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_dashboard-active.png" alt="">
						</div>
						<div class="textbox">
							ダッシュボード
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('partner.project.index') }}" class="{{ strpos(request()->route()->getName(), 'project') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_inbox.png" alt="">
						</div>
						<div class="textbox">
							プロジェクト
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('partner.task.index') }}" class="{{ strpos(request()->route()->getName(), 'task') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_products.png" alt="">
						</div>
						<div class="textbox">
							タスク
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('partner.document.index') }}" class="{{ strpos(request()->route()->getName(), 'document') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_invoices.png" alt="">
						</div>
						<div class="textbox">
							書類
						</div>
					</a>
				</li>
				<li>
					<a href="{{ route('partner.setting.invoice.create') }}" class="{{ strpos(request()->route()->getName(), 'setting') ? 'isActive' : '' }}">
						<div class="icon-imgbox">
							<img src="{{ env('AWS_URL') }}/common/icon_setting.png" alt="">
						</div>
						<div class="textbox">
							設定
						</div>
					</a>
				</li>
			</ul>
			@endif
		</aside>
	</div>
</div>
