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

	<form action="{{ route('company.invite.partner.send') }}" method="POST">
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

		<div class='button-container'>
			<button type="button" onclick="submit();">メールを送信する</button>
		</div>
	</form>
</div>
@endsection
