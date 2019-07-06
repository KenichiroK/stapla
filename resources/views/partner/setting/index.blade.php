@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/setting/index.css') }}">
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
    user name
</div>
<div class="navbar-item">
    <img src="../../images/dummy_user.jpeg" alt="プロフィール画像">
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

	<form action="" method="POST">
		@csrf
		<div class="profile-container">
			<div class="title-container">
				<h4>基本情報</h4>
			</div>
			<div class="name-container">
				<p>屋号 / 名前</p>
				<input type="text" name="name">
			</div>

			<div class="above-address-container">
				<div class="zipcode-container">
					<p>郵便番号</p>
					<input type="text" name="zipcode">
				</div>

				<div class="prefecture-container">
					<p>都道府県</p>
					<div class="selectbox-container">
						<select name="prefecture">
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
					<input type="text" name="city">
				</div>

				<div class="building-container">
					<p>建物名・部屋番号</p>
					<input type="text" name="building">
				</div>
			</div>

			<div class="tel-container">
				<p>電話番号</p>
				<input type="text" name="tel">
			</div>
		</div>

		<div class="invoice-container">
			<div class="title-container">
				<h4>請求情報</h4>
			</div>

			<div class="financial-container">
				<div class="financialInstitution-container">
					<p>金融機関</p>
					<input type="text" name="financial_institution">
				</div>

				<div class="branch-container">
					<p>支店</p>
					<input type="text" name="branch">
				</div>
			</div>

			<div class="depositType-container">
				<p>預金種類</p>
				<input type="text" name="deposit_type">
			</div>

			<div class="accountNumber-container">
				<p>口座番号</p>
				<input type="text" name="account_number">
			</div>

			<div class="accountHolder-container">
				<p>口座名義</p>
				<input type="text" name="account_holder">
			</div>
			
			<div class="mark-container">
				<p class="title">請求書印</p>
				<p class="caution">背景が透明な140px以上の正方形のpng画像を用意してください。</p>
				<div class="image-container">
					<img id="preview" src="../../images/preview.jpeg" alt="プレビュー画像" width="140px" height="140px">
					<label for="mark_image">
					 画像をアップロード
					<input type="file" id="mark_image" style="display: none;" onchange="setPreview(this)" name="mark">
				</label>
				</div>

				<div class="imprint-container">
					<button>電子印影を作成</button>
				</div>
			</div>
		</div>

		<div class="btn-container">
			<button type="submit">設定</button>
		</div>
	</form>
</div>
@endsection
