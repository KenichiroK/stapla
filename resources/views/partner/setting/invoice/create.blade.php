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
      preview.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}

const setPostal = () => {
  const front = document.getElementById('postal_front').value;
  const back = document.getElementById('postal_back').value;
  const postal = document.getElementById('postal');
  postal.value = front + back;
}

window.onload = () => {
  const front = document.getElementById('postal_front').value;
  const back = document.getElementById('postal_back').value;
  const postal = document.getElementById('postal');
  postal.value = front + back;
}
</script>
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
<?php
$pref = array(
    '北海道',
    '青森県',
    '岩手県',
    '宮城県',
    '秋田県',
    '山形県',
    '福島県',
    '茨城県',
    '栃木県',
    '群馬県',
    '埼玉県',
    '千葉県',
    '東京都',
    '神奈川県',
    '新潟県',
    '富山県',
    '石川県',
    '福井県',
    '山梨県',
    '長野県',
    '岐阜県',
    '静岡県',
    '愛知県',
    '三重県',
    '滋賀県',
    '京都府',
    '大阪府',
    '兵庫県',
    '奈良県',
    '和歌山県',
    '鳥取県',
    '島根県',
    '岡山県',
    '広島県',
    '山口県',
    '徳島県',
    '香川県',
    '愛媛県',
    '高知県',
    '福岡県',
    '佐賀県',
    '長崎県',
    '熊本県',
    '大分県',
    '宮崎県',
    '鹿児島県',
    '沖縄県'
);
?>
<div class="main-wrapper">
	@if (session('completed'))
	<div class="complete-container">
		<p>{{ session('completed') }}</p>
	</div>
	@endif

	@if(count($errors) > 0)
	<div class="error-container">
		<p>入力に問題があります。再入力して下さい。</p>
	</div>
  	@endif

	@if(Session::has('not_register_invoice'))
	<div class="error-container">
		<p>{{ session('not_register_invoice') }}</p>
	</div>
  	@endif

	<div class="title-container">
		<h3>設定</h3>
	</div>

	<div class="menu-container">
		<ul>
			<li><a href="/partner/setting/invoice" class="isActive">請求情報設定</a></li>
			<li><a href="#">メールアドレス・パスワード設定</a></li>
			<li><a href="/partner/setting/notification">通知設定</a></li>
			<li><a href="#">個人情報の設定</a></li>
		</ul>
	</div>

	<form action="{{ url('partner/setting/invoice') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="profile-container">
			<div class="title-container">
				<h4>基本情報</h4>
			</div>
			<div class="name-container">
				<p>屋号 / 名前</p>
				@if ($partner)
					<input type="text" name="name" value="{{ old('name', $partner->name) }}">
				@else
					<input type="text" name="name" value="{{ old('name') }}">
				@endif
				@if ($errors->has('name'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('name') }}</strong>
					</div>
				@endif
			</div>

			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					<div class="zipcode-container__wrapper">
						@if ($partner)
							<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front', substr($partner->zip_code, 0, 3)) }}" onchange="setPostal()">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back', substr($partner->zip_code, 3, 7)) }}" onchange="setPostal()">
							<input id="postal" type="hidden" name="zip_code">
						@else
							<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front') }}" onchange="setPostal()">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back') }}" onchange="setPostal()">
							<input id="postal" type="hidden" name="zip_code">
						@endif
					</div>
					@if ($errors->has('zip_code_front'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('zip_code_front') }}</strong>
						</div>
					@endif
					@if ($errors->has('zip_code_back') && !$errors->has('zip_code_front'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('zip_code_back') }}</strong>
						</div>
					@endif
				</div>

				<div class="prefecture-container">
					<p>都道府県</p>
					<div class="select-arrow">
						<select name="prefecture">
							@foreach($pref as $_pref)
							<option value="{{ $_pref }}" {{ ($partner->prefecture === $_pref) ? 'selected' : '' }}>{{ $_pref }}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('prefecture'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('prefecture') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="below-address-container">
				<div class="city-container">
					<p>市区町村・番地</p>
					@if ($partner)
						<input type="text" name="city" value="{{ old('city', $partner->city) }}">
					@else
						<input type="text" name="city" value="{{ old('city') }}">
					@endif
					@if ($errors->has('city'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('city') }}</strong>
						</div>
					@endif
				</div>

				<div class="building-container">
					<p>番地</p>
					@if ($partner)
						<input type="text" name="street" value="{{ old('street', $partner->street) }}">
					@else
						<input type="text" name="street" value="{{ old('street') }}">
					@endif
					@if ($errors->has('street'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('street') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="below-address-container">
				<div class="building-container">
					<p>建物名・部屋番号</p>
					@if ($partner)
						<input type="text" name="building" value="{{ old('building', $partner->building) }}">
					@else
						<input type="text" name="building" value="{{ old('building') }}">
					@endif
					@if ($errors->has('building'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('building') }}</strong>
						</div>
					@endif
				</div>

				<div class="tel-container">
					<p>電話番号</p>
					<div class="tel-container__wrapper">
						@if ($partner)
							<input type="text" name="tel" value="{{ old('tel', $partner->tel) }}" placeholder="">
								<span class="hyphen">
									<hr>
								</span>
							<input type="text">
								<span class="hyphen">
									<hr>
								</span>
							<input type="text">
							<!-- <input type="text" name="tel" value="{{ old('tel', $partner->tel) }}"> -->
						@else
							<input type="text" name="tel" value="{{ old('tel') }}">
						@endif
						@if ($errors->has('tel'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('tel') }}</strong>
							</div>					
						@endif
					</div>
				</div>
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
					@else
						<input type="text" name="financial_institution" value="{{ old('financial_institution') }}">
					@endif
					@if ($errors->has('financial_institution'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('financial_institution') }}</strong>
						</div>
					@endif
				</div>

				<div class="branch-container">
					<p>支店</p>
					@if ($partner_invoice)
						<input type="text" name="branch" value="{{ old('branch', $partner_invoice->branch) }}">
					@else
						<input type="text" name="branch" value="{{ old('branch') }}">
					@endif
					@if ($errors->has('branch'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('branch') }}</strong>
						</div>
					@endif
				</div>
			</div>

			<div class="depositType-container">
				<p>預金種類</p>
				@if ($partner_invoice)
					<input type="text" name="deposit_type" value="{{ old('deposit_type', $partner_invoice->deposit_type) }}">
				@else
					<input type="text" name="deposit_type" value="{{ old('deposit_type') }}">
				@endif
				@if ($errors->has('deposit_type'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('deposit_type') }}</strong>
					</div>
				@endif
			</div>

			<div class="accountNumber-container">
				<p>口座番号</p>
				@if ($partner_invoice)
					<input type="text" name="account_number" value="{{ old('account_number', $partner_invoice->account_number) }}">
				@else
					<input type="text" name="account_number" value="{{ old('account_number') }}">
				@endif
				@if ($errors->has('account_number'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('account_number') }}</strong>
					</div>
				@endif
			</div>

			<div class="accountHolder-container">
				<p>口座名義</p>
				@if ($partner_invoice)
					<input type="text" name="account_holder" value="{{ old('account_holder', $partner_invoice->account_holder) }}">
				@else
					<input type="text" name="account_holder" value="{{ old('account_holder') }}">
				@endif
				@if ($errors->has('account_holder'))
					<div>
						<strong style='color: #e3342f;'>{{ $errors->first('account_holder') }}</strong>
					</div>
				@endif
			</div>
			
			<div class="mark-container">
				<p class="title">請求書印</p>
				<p class="caution">背景が透明な140px以上の正方形のpng画像を用意してください。</p>
				<div class="image-container">
					@if ($partner_invoice)
						<div class="imgbox">
							<img id="preview" src="/{{ str_replace('public/', 'storage/', $partner_invoice->mark_image) }}" alt="プレビュー画像">
						</div>	
					@else
						<div class="imgbox">
							<img id="preview" src="../../../images/upload3.png" alt="プレビュー画像">
						</div>
					@endif
					<div>
					<label for="mark_image">
						画像をアップロード
						<input type="file" id="mark_image" name="mark_image" style="display: none;" accept="image/png" onchange="setPreview(this)">
					</label>
					@if ($errors->has('mark_image'))
						<div class="image-error_message">
							<strong style='color: #e3342f;'>{{ $errors->first('mark_image') }}</strong>
						</div>
					@endif
					</div>
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
