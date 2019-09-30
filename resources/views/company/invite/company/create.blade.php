@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/invite/company/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>担当者に招待メールを送る</h3>
	</div>

	<form action="" method="POST">
		<div class='input-container'>
			<p>メールアドレス</p>
			<input type="email" required>
		</div>

		<div class='input-container'>
			<p>仮パスワード</p>
			<input type="password" required>
		</div>

		<div class='input-container'>
			<p>仮パスワード 確認</p>
			<input type="password" required>
		</div>

		<div class='button-container'>
			<button>メールを送信する</button>
		</div>
	</form>
</div>
@endsection
