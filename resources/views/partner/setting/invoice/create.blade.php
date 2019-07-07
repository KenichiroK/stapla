@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/setting/invoice/index.css') }}">
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

@section('header-profile')
<div class="navbar-item">
    {{ $partner->name }}
</div>
<div class="navbar-item">
	<a href="/partner/profile">
		<img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
	</a>
</div>
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
                <li><a href="/partner/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/partner/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/partner/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/partner/setting/invoice" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
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
			<li><a href="/partner/setting/invoice" class="isActive">請求情報設定</a></li>
			<li><a href="/partner/setting/email">メールアドレス・パスワード設定</a></li>
			<li><a href="/partner/setting/notification">通知設定</a></li>
			<li><a href="/partner/setting/personal">個人情報の設定</a></li>
		</ul>
	</div>

	<form action="{{ url('partner/setting/invoice') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="profile-container">
			<div class="title-container">
				<h4>基本情報</h4>
			</div>
			<div class="name-container">
				<p>屋号 / 名前</p>
				@if ($partner)
					<input type="text" name="name" value="{{ old('name', $partner->name) }}">
					@if ($errors->has('name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('name') }}</strong>
						</div>
					@endif
				@else
					<input type="text" name="name" value="{{ old('name') }}">
					@if ($errors->has('name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('name') }}</strong>
						</div>					
					@endif
				@endif
			</div>

			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					@if ($partner)
						<input type="text" name="zip_code" value="{{ old('zip_code', $partner->zip_code) }}">
						@if ($errors->has('zip_code'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="zip_code" value="{{ old('zip_code') }}">
						@if ($errors->has('zip_code'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
					@endif
				</div>

				<div class="prefecture-container">
					<p>都道府県</p>
					@if ($partner)
						<input type="text" name="prefecture" value="{{ old('prefecture', $partner->prefecture) }}">
						@if ($errors->has('prefecture'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('prefecture') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="prefecture" value="{{ old('prefecture') }}">
						@if ($errors->has('prefecture'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('prefecture') }}</strong>
							</div>
						@endif
					@endif
				</div>
			</div>

			<div class="below-address-container">
				<div class="city-container">
					<p>市区町村・番地</p>
					@if ($partner)
						<input type="text" name="city" value="{{ old('city', $partner->city) }}">
						@if ($errors->has('city'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('city') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="city" value="{{ old('city') }}">
						@if ($errors->has('city'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('city') }}</strong>
							</div>
						@endif
					@endif
				</div>

				<div class="building-container">
					<p>建物名・部屋番号</p>
					@if ($partner)
						<input type="text" name="building" value="{{ old('building', $partner->building) }}">
						@if ($errors->has('building'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('building') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="building" value="{{ old('building') }}">
						@if ($errors->has('building'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('building') }}</strong>
							</div>
						@endif
					@endif
				</div>
			</div>

			<div class="tel-container">
				<p>電話番号</p>
				@if ($partner)
					<input type="text" name="tel" value="{{ old('tel', $partner->tel) }}">
					@if ($errors->has('tel'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('tel') }}</strong>
						</div>
					@endif
				@else
					<input type="text" name="tel" value="{{ old('tel') }}">
					@if ($errors->has('tel'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('tel') }}</strong>
						</div>					
					@endif
				@endif
			</div>
		</div>

		<div class="invoice-container">
			<div class="title-container">
				<h4>請求情報</h4>
			</div>

			<div class="financial-container">
				<div class="financialInstitution-container">
					<p>金融機関</p>
					@if ($partner_invoice)
						<input type="text" name="financial_institution" value="{{ old('financial_institution', $partner_invoice->financial_institution) }}">
						@if ($errors->has('financial_institution'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('financial_institution') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="financial_institution" value="{{ old('financial_institution') }}">
						@if ($errors->has('financial_institution'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('financial_institution') }}</strong>
							</div>						
						@endif
					@endif
				</div>

				<div class="branch-container">
					<p>支店</p>
					@if ($partner_invoice)
						<input type="text" name="branch" value="{{ old('branch', $partner_invoice->branch) }}">
						@if ($errors->has('branch'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('branch') }}</strong>
							</div>
						@endif
					@else
						<input type="text" name="branch" value="{{ old('branch') }}">
						@if ($errors->has('branch'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('branch') }}</strong>
							</div>
						@endif
					@endif
				</div>
			</div>

			<div class="depositType-container">
				<p>預金種類</p>
				@if ($partner_invoice)
					<input type="text" name="deposit_type" value="{{ old('deposit_type', $partner_invoice->deposit_type) }}">
					@if ($errors->has('deposit_type'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('deposit_type') }}</strong>
						</div>
					@endif
				@else
					<input type="text" name="deposit_type" value="{{ old('deposit_type') }}">
					@if ($errors->has('deposit_type'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('deposit_type') }}</strong>
						</div>
					@endif
				@endif
			</div>

			<div class="accountNumber-container">
				<p>口座番号</p>
				@if ($partner_invoice)
					<input type="text" name="account_number" value="{{ old('account_number', $partner_invoice->account_number) }}">
					@if ($errors->has('account_number'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('account_number') }}</strong>
						</div>
					@endif
				@else
					<input type="text" name="account_number" value="{{ old('account_number') }}">
					@if ($errors->has('account_number'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('account_number') }}</strong>
						</div>
					@endif
				@endif
			</div>

			<div class="accountHolder-container">
				<p>口座名義</p>
				@if ($partner_invoice)
					<input type="text" name="account_holder" value="{{ old('account_holder', $partner_invoice->account_holder) }}">
					@if ($errors->has('account_holder'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('account_holder') }}</strong>
						</div>
					@endif
				@else
					<input type="text" name="account_holder" value="{{ old('account_holder') }}">
					@if ($errors->has('account_holder'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('account_holder') }}</strong>
						</div>
					@endif
				@endif
			</div>
			
			<div class="mark-container">
				<p class="title">請求書印</p>
				<p class="caution">背景が透明な140px以上の正方形のpng画像を用意してください。</p>
				<div class="image-container">
					@if ($partner_invoice)
						<img id="preview" src="/{{ $mark_image }}" alt="プレビュー画像" width="140px" height="140px">
					@else
						<img id="preview" src="../../images/preview.jpeg" alt="プレビュー画像" width="140px" height="140px">
					@endif
					<label for="mark_image">
						画像をアップロード
						<input type="file" id="mark_image" name="mark_image" style="display: none;" onchange="setPreview(this)">
					</label>
				@if ($errors->has('mark_image'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('mark_image') }}</strong>
					</div>
				@endif
				</div>

				<div class="imprint-container">
					<button type="button">電子印影を作成</button>
				</div>
			</div>
		</div>

		<div class="btn-container">
			<button type="submit">設定</button>
		</div>
	</form>
</div>
@endsection
