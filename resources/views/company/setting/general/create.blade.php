 @extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/setting/general/index.css') }}">
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
  const postal_front = document.getElementById('postal_front').value;
  const postal_back = document.getElementById('postal_back').value;
  const postal = document.getElementById('postal');
  postal.value = postal_front + postal_back;
}

window.onload = () => {
  setPostal();
}
</script>
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
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
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
                    <a href="/company/setting/general" class="isActive">
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
	'',
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
    
	<div class="title-container">
		<h3>設定</h3>
	</div>
	<div class="menu-container">
		<ul>
			<li><a href="/company/setting/general" class="isActive">会社基本情報設定</a></li>
			<li><a href="/company/setting/companyElse">会社その他の設定</a></li>
			<li><a href="/company/setting/userSetting">会社担当者設定</a></li>
			<li><a href="/company/setting/account">アカウント設定</a></li>
			<li><a href="/company/setting/personalInfo">個人情報の設定</a></li>
		</ul>
	</div>
	<div class=profile-container>
		<form action="{{ url('/company/setting/general') }}" method="POST">
		@csrf
			<div class="top-area">
				<div class="name-container">
					<p>会社名</p>
					@if($company)
						<input class="top-input input" type="" name="company_name" value="{{ old('company_name', $company->company_name) }}" placeholder="">
					@else
						<input class="top-input input" type="" name="company_name" value="{{ old('company_name') }}" placeholder="">
					@endif
					@if ($errors->has('company_name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('company_name') }}</strong>
						</div>
					@endif
				</div>
				<div class="name-container">
					<p>代表者名</p>
					@if($company)
						<input class="top-input input" type="text" name="representive_name" value="{{ old('representive_name', $company->representive_name) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="representive_name" value="{{ old('representive_name') }}" placeholder="">
					@endif
					@if ($errors->has('representive_name'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('representive_name') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					<div class="zipcode-container__wrapper">
						@if($company)
							<input id="postal_front" class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front', substr($company->zip_code, 0, 3)) }}" onchange="setPostal()">
							<span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back', substr($company->zip_code, 3, 7)) }}" onchange="setPostal()">
                            <input id="postal" type="hidden" name="zip_code">
						@else
							<input class="top-input input" type="text" name="zip_code_front" value="{{ old('zip_code_front') }}" onchange="setPostal()">
                            <span class="hyphen">
								<hr>
							</span>
							<input id="postal_back" type="text" name="zip_code_back" value="{{ old('zip_code_back') }}" onchange="setPostal()">
                            <input id="postal" type="hidden" name="zip_code">
						@endif
						@if ($errors->has('zip_code'))
							<div>
								<strong style='color: #e3342f;'>{{ $errors->first('zip_code') }}</strong>
							</div>
						@endif
					</div>
				</div>
	
				<div class="prefecture-container">
					<p>都道府県</p>
					<div class="select-arrow">
						<select name="address_prefecture" id="prefecture">
							@foreach($pref as $_pref)
							<option value="{{ $_pref }}" {{ ($company->address_prefecture === $_pref) ? 'selected' : ''}}>{{ $_pref }}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('address_prefecture'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_prefecture') }}</strong>
						</div>
					@endif
				</div>
			</div>
			
			<div class="below-address-container">
				<div class="city-container">
					<p>市区町村・番地</p>
					@if($company)
						<input class="top-input input" type="text" name="address_city" value="{{ old('address_city', $company->address_city) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="address_city" value="{{ old('address_city') }}" placeholder="">
					@endif
					@if ($errors->has('address_city'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_city') }}</strong>
						</div>
					@endif
				</div>
	
				<div class="building-container">
					<p>建物名・部屋番号</p>
					@if ($company)
						<input type="text" name="address_building" value="{{ old('address_building', $company->address_building) }}">
					@else
						<input type="text" name="address_building" value="{{ old('address_building') }}">
					@endif
					@if ($errors->has('address_building'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_building') }}</strong>
						</div>
					@endif
				</div>
			</div>
			<div class="btn-container">
				<button type="submit">設定</button>
			</div>
		</form>
	</div>
</div>
@endsection
