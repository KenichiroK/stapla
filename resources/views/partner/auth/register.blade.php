@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/invite/partner/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>パートナーに招待メールを送る</h3>
	</div>

	<div class="main_container">
		<div class="form_wrapper">
			<form method="POST" action="{{ route('company.invite.partner.send') }}">
				@csrf
				<div class='input-container'>
					<p>メールアドレス</p>
					<input class="input_text" type="email" name="email" placeholder="impro@example.com">
					@if($errors->has('email'))
						<div class="error-mes-wrp">
							<strong style='color: #e3342f;'>{{ $errors->first('email') }}</strong>
						</div>
					@endif
				</div>

				<div class='input-container'>
					<p>パスワード</p>
					<input class="input_text" type="password" name="password">
					@if ($errors->has('password'))
						<div class="invalid-feedback error-msg" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</div>
					@endif
				</div>

				<div class='input-container'>
					<p>パスワード確認</p>
					<input class="input_text" type="password" name="password_confirmation">
					@if ($errors->has('password'))
						<div class="invalid-feedback error-msg" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</div>
					@endif
				</div>
				<div class='input-container'>
					<p>企業ID</p>
					<!-- <input class="input_text" type="hidden" name="company_id" value="{{ $company_user->company_id }}"> -->
					<input class="input_text" type="" name="company_id" value="{{ $company_user->company_id }}">
				</div>

				<div class='button-container'>
					<button type="button" onclick="submit();">メールを送信する</button>
				</div>
			</form>
			
		</div>
	</div>
</div>
@endsection
