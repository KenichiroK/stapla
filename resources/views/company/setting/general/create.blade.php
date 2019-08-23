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
<div class="main-wrapper">
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
							<input class="top-input input" type="text" name="zip_code" value="{{ old('zip_code', $company->zip_code) }}" placeholder="">
							<span class="hyphen">
								<hr>
								<!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
							</span>
							<input type="text">
						@else
							<input class="top-input input" type="text" name="zip_code" value="{{ old('zip_code') }}" placeholder="">
							-<input type="text">
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
					<!-- @if($company)
						<input class="top-input input" type="text" name="address_prefecture" value="{{ old('address_prefecture', $company->address_prefecture) }}" placeholder="">
					@else
						<input class="top-input input" type="text" name="address_prefecture" value="{{ old('address_prefecture') }}" placeholder="">
					@endif
					@if ($errors->has('address_prefecture'))
						<div>
							<strong style='color: #e3342f;'>{{ $errors->first('address_prefecture') }}</strong>
						</div>
					@endif -->
					<div class="select-arrow">
						<select name="pref">
							<option value=""></option>
							<option value="北海道">北海道</option>
							<option value="青森県">青森県</option>
							<option value="岩手県">岩手県</option>
							<option value="宮城県">宮城県</option>
							<option value="秋田県">秋田県</option>
							<option value="山形県">山形県</option>
							<option value="福島県">福島県</option>
							<option value="茨城県">茨城県</option>
							<option value="栃木県">栃木県</option>
							<option value="群馬県">群馬県</option>
							<option value="埼玉県">埼玉県</option>
							<option value="千葉県">千葉県</option>
							<option value="東京都">東京都</option>
							<option value="神奈川県">神奈川県</option>
							<option value="新潟県">新潟県</option>
							<option value="富山県">富山県</option>
							<option value="石川県">石川県</option>
							<option value="福井県">福井県</option>
							<option value="山梨県">山梨県</option>
							<option value="長野県">長野県</option>
							<option value="岐阜県">岐阜県</option>
							<option value="静岡県">静岡県</option>
							<option value="愛知県">愛知県</option>
							<option value="三重県">三重県</option>
							<option value="滋賀県">滋賀県</option>
							<option value="京都府">京都府</option>
							<option value="大阪府">大阪府</option>
							<option value="兵庫県">兵庫県</option>
							<option value="奈良県">奈良県</option>
							<option value="和歌山県">和歌山県</option>
							<option value="鳥取県">鳥取県</option>
							<option value="島根県">島根県</option>
							<option value="岡山県">岡山県</option>
							<option value="広島県">広島県</option>
							<option value="山口県">山口県</option>
							<option value="徳島県">徳島県</option>
							<option value="香川県">香川県</option>
							<option value="愛媛県">愛媛県</option>
							<option value="高知県">高知県</option>
							<option value="福岡県">福岡県</option>
							<option value="佐賀県">佐賀県</option>
							<option value="長崎県">長崎県</option>
							<option value="熊本県">熊本県</option>
							<option value="大分県">大分県</option>
							<option value="宮崎県">宮崎県</option>
							<option value="鹿児島県">鹿児島県</option>
							<option value="沖縄県">沖縄県</option>
						</select>
					</div>
					
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
		</form>
	</div>
	<div class="btn-container">
		<button type="submit">設定</button>
	</div>
</div>
@endsection
